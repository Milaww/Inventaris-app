<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitBarang;
use App\Models\barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index()
    {
        // $twoDaysAgo = Carbon::now()->subDays(2);
        // Data statistik
        $totalBarang = barang::count();
        $unitTersedia = UnitBarang::where('status', 'aktif')->count();
        // $unitDipinjam = UnitBarang::where('status', 'dipinjam')->count();
        $unitRusak = UnitBarang::where('status', 'rusak')->count();
        $unitTotal = UnitBarang::count();
        $unitTerbaru = UnitBarang::latest()->take(5)->get();

        // Mutasi Barang Masuk
        $barangMasuk = BarangMasuk::with(['barang', 'unitBarang'])
            ->select('id', 'barang_id', 'unit_barang_id', 'created_at')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'tipe' => 'masuk',
                    'nama_barang' => $item->barang->nama_brg ?? '-',
                    'kode_inventaris' => $item->unitBarang->kode_inventaris ?? '-',
                    'tanggal' => $item->created_at,
                ];
            });

        // Mutasi Barang Keluar
        $barangKeluar = BarangKeluar::with(['barang', 'unitBarang'])
            ->select('id', 'barang_id', 'unit_barang_id', 'created_at')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'tipe' => 'keluar',
                    'nama_barang' => $item->barang->nama_brg ?? '-',
                    'kode_inventaris' => $item->unitBarang->kode_inventaris ?? '-',
                    'tanggal' => $item->created_at,
                ];
            });

        // Gabungkan dan ambil 5 terbaru
        $mutasiTerbaru = $barangMasuk
            ->merge($barangKeluar)
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();

        // Kirim semua data ke view
        return view('dashboard', compact(
            'totalBarang',
            'unitTersedia',
            // 'unitDipinjam',
            'unitRusak',
            'unitTotal',
            'unitTerbaru',
            'mutasiTerbaru'
        ));
    }
}
