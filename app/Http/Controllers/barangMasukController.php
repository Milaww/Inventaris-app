<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Divisi;
use App\Models\UnitBarang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{


    // Tampilkan daftar barang masuk
    public function index(Request $request)
    {
        $query = BarangMasuk::with([
            'barang.kategori',
            'unitBarang.divisi.lokasi'
        ])->latest();

        // Filter status
        if ($request->filled('status')) {
            $query->whereHas('unitBarang', function($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        // Filter lokasi
        if ($request->filled('lokasi_id')) {
            $query->whereHas('unitBarang.lokasi', function($q) use ($request) {
                $q->where('id', $request->lokasi_id);
            });
        }
        //filter kategori
        if ($request->filled('kategori_id')) {
            $query->whereHas('barang.kategori', function($q) use ($request) {
                $q->where('id', $request->kategori_id);
            });
        }

        // Filter tanggal masuk (format: yyyy-mm-dd)
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Pencarian nama barang
        if ($request->filled('q')) {
            $query->whereHas('barang', function($q) use ($request) {
                $q->where('nama_brg', 'like', '%' . $request->q . '%');
            });
        }

        $barangMasuks = $query->get();

        // Untuk dropdown lokasi dan status
        $daftarLokasi = \App\Models\Lokasi::all();
        $daftarStatus = ['aktif', 'rusak'];
        $daftarKategori = \App\Models\Kategori::all();

        return view('barang-masuk.index', compact('barangMasuks', 'daftarLokasi', 'daftarStatus', 'daftarKategori'));
    }
}
