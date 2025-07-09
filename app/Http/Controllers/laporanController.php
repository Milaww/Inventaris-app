<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class laporanController extends Controller
{

            public function index()
        {
            $daftarLokasi = \App\Models\Lokasi::all(); // Ambil semua lokasi dari database
            return view('laporan.index', compact('daftarLokasi'));
        }




            public function cetak(Request $request)
        {
            $tanggal = $request->tanggal;
            $jenis = $request->jenis;
            $lokasiId = $request->lokasi_id;
            $status = $request->status;

            // === CETAK SEMUA DATA TANPA FILTER ===
            if (!$tanggal && !$jenis && !$lokasiId && !$status) {
                $data = [
                    'masuk' => \App\Models\BarangMasuk::with(['barang.kategori', 'unitBarang.lokasi'])->get(),
                    'keluar' => \App\Models\BarangKeluar::with(['barang.kategori', 'unitBarang.lokasi'])->get(),
                ];
                $tanggal = now()->format('Y-m-d'); // tanggal default
                return Pdf::loadView('laporan.cetak-semua', compact('data', 'tanggal'))->stream("laporan-semua-{$tanggal}.pdf");
            }

            // === FILTER MASUK SAJA ===
            if ($jenis === 'masuk') {
                $query = \App\Models\BarangMasuk::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal));

                if ($lokasiId) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('lokasi_id', $lokasiId));
                }

                if ($status) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('status', $status));
                }

                $data = $query->get();
                $view = 'laporan.cetak-masuk';
            }

            // === FILTER KELUAR SAJA ===
            elseif ($jenis === 'keluar') {
                $query = \App\Models\BarangKeluar::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal));

                if ($lokasiId) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('lokasi_id', $lokasiId));
                }

                if ($status) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('status', $status));
                }

                $data = $query->get();
                $view = 'laporan.cetak-keluar';
            }

            // === MUTASI MASUK & KELUAR ===
            else {
                $masukQuery = \App\Models\BarangMasuk::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal));

                $keluarQuery = \App\Models\BarangKeluar::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal));

                if ($lokasiId) {
                    $masukQuery->whereHas('unitBarang', fn($q) => $q->where('lokasi_id', $lokasiId));
                    $keluarQuery->whereHas('unitBarang', fn($q) => $q->where('lokasi_id', $lokasiId));
                }

                if ($status) {
                    $masukQuery->whereHas('unitBarang', fn($q) => $q->where('status', $status));
                    $keluarQuery->whereHas('unitBarang', fn($q) => $q->where('status', $status));
                }

                $data = [
                    'masuk' => $masukQuery->get(),
                    'keluar' => $keluarQuery->get(),
                ];
                $view = 'laporan.cetak-mutasi';
            }

            return Pdf::loadView($view, compact('data', 'tanggal'))->stream("laporan-{$jenis}-{$tanggal}.pdf");
        }





}
