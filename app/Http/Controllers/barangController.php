<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Divisi;
use App\Models\UnitBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::withCount('unitBarangs')->with('kategori');

        // Filter kategori jika ada
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Pencarian nama barang jika ada
        if ($request->filled('q')) {
            $query->where('nama_brg', 'like', '%' . $request->q . '%');
        }

        $barangs = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::all();

        return view('barang.index', compact('barangs', 'kategoris'));
    }


    // Form tambah barang
    public function create()
    {
        $kategoris = Kategori::all();
        $divisis = Divisi::with('lokasi')->get();
        return view('barang.create', compact('kategoris', 'divisis'));
    }

    // Simpan barang baru + unit
    public function store(Request $request)
    {
        $request->validate([
            'nama_brg' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_inventaris' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisis,id',
            'pic' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,rusak',
        ]);

        // Simpan barang
        $barang = Barang::create([
            'nama_brg' => $request->nama_brg,
            'kategori_id' => $request->kategori_id,
        ]);

        // Ambil lokasi_id dari divisi yang dipilih
        $divisi = Divisi::findOrFail($request->divisi_id);

        // Simpan unit barang
        $unit = $barang->unitBarangs()->create([
            'kode_inventaris' => $request->kode_inventaris,
            'divisi_id' => $request->divisi_id,
            'lokasi_id' => $divisi->lokasi_id,
            'pic' => $request->pic,
            'foto' => $request->file('foto') ? $request->file('foto')->store('unit_barang', 'public') : null,
            'status' => $request->status,
        ]);

        // Simpan ke tabel barang_masuk
        BarangMasuk::create([
            'barang_id' => $barang->id,
            'unit_barang_id' => $unit->id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang dan unit berhasil ditambahkan.');
    }

    // Tampilkan detail barang
    public function show($id)
    {
        $barang = Barang::with(['kategori', 'unitBarangs.lokasi', 'unitBarangs.divisi'])->findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    // Form edit barang
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    // Update barang
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_brg' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Hapus barang
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    // Form tambah unit barang
    public function createUnit()
    {
        $barangs = Barang::with('kategori')->get();
        $divisis = Divisi::with('lokasi')->get();

        return view('barang.tambahUnit', compact('barangs', 'divisis'));
    }


    //store unit barang
    public function storeUnit(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'kode_inventaris' => 'required|string|max:255|unique:unit_barang,kode_inventaris',
            'divisi_id' => 'required|exists:divisis,id',
            'pic' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,rusak',
        ]);

        $divisi = Divisi::findOrFail($request->divisi_id);

        // Simpan unit barang
        $unit = UnitBarang::create([
            'barang_id' => $request->barang_id,
            'kode_inventaris' => $request->kode_inventaris,
            'divisi_id' => $request->divisi_id,
            'lokasi_id' => $divisi->lokasi_id,
            'pic' => $request->pic,
            'foto' => $request->file('foto') ? $request->file('foto')->store('unit_barang', 'public') : null,
            'status' => $request->status,
        ]);

        // Simpan ke barang_masuk
        BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'unit_barang_id' => $unit->id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Unit barang berhasil ditambahkan.');
    }


    //form edit unit barang
    public function editUnit($barangId, $unitId)
    {
        $barang = Barang::findOrFail($barangId);
        $unit = UnitBarang::where('id', $unitId)->where('barang_id', $barangId)->firstOrFail();
        $divisis = Divisi::with('lokasi')->get();

        return view('barang.unit-edit', compact('barang', 'unit', 'divisis'));
    }

    //form update unit barang
    public function updateUnit(Request $request, $barangId, $unitId)
    {
        $request->validate([
            'kode_inventaris' => 'required|string|max:255',
            'status' => 'required|in:aktif,rusak',
            'divisi_id' => 'required|exists:divisis,id',
            'pic' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $unit = UnitBarang::where('id', $unitId)->where('barang_id', $barangId)->firstOrFail();

        $unit->update([
            'kode_inventaris' => $request->kode_inventaris,
            'status' => $request->status,
            'divisi_id' => $request->divisi_id,
            'pic' => $request->pic,
            'foto' => $request->file('foto') ? $request->file('foto')->store('unit_barang', 'public') : $unit->foto,
        ]);

        // Jika status berubah ke rusak/habis, log ke barang_keluar
        // Catat status lama sebelum update
       $oldStatus = $unit->getOriginal('status');

        // Jika sebelumnya bukan rusak dan sekarang menjadi rusak
        if ($oldStatus !== 'rusak' && $request->status === 'rusak') {
            BarangKeluar::create([
                'barang_id' => $unit->barang_id,
                'unit_barang_id' => $unit->id,
            ]);
        }


        return redirect()->route('barang.show', $barangId)->with('success', 'Unit barang berhasil diperbarui.');
    }

    //hapus unit barang
    public function destroyUnit($barangId, $unitId)
    {
        $unit = UnitBarang::where('id', $unitId)->where('barang_id', $barangId)->firstOrFail();
        $unit->delete();

        return redirect()->route('barang.show', $barangId)->with('success', 'Unit barang berhasil dihapus.');
    }

}
