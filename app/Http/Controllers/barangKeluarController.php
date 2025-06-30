<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitBarang;
use App\Models\BarangKeluar;


class barangKeluarController extends Controller
{
    public function index(Request $request)
{
    $query = UnitBarang::with(['barang', 'barang.kategori', 'lokasi'])
                ->where('status', 'rusak');

    // Filter opsional
    if ($request->filled('tanggal')) {
        $query->whereDate('updated_at', $request->tanggal);
    }

    if ($request->filled('lokasi_id')) {
        $query->where('lokasi_id', $request->lokasi_id);
    }

    if ($request->filled('q')) {
        $query->whereHas('barang', function ($q) use ($request) {
            $q->where('nama_brg', 'like', '%' . $request->q . '%');
        });
    }

    $unitRusak = $query->get();

    return view('barang-keluar.index', [
        'unitRusak' => $unitRusak,
        'daftarLokasi' => \App\Models\Lokasi::all()
    ]);
}

}
