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

            if ($jenis === 'masuk') {
                $query = \App\Models\BarangMasuk::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->whereDate('created_at', $tanggal);

                if ($lokasiId) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('lokasi_id', $lokasiId));
                }

                if ($status) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('status', $status));
                }

                $data = $query->get();
                $view = 'laporan.cetak-masuk';
            }

            elseif ($jenis === 'keluar') {
                $query = \App\Models\BarangKeluar::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->whereDate('created_at', $tanggal);

                if ($lokasiId) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('lokasi_id', $lokasiId));
                }

                if ($status) {
                    $query->whereHas('unitBarang', fn($q) => $q->where('status', $status));
                }

                $data = $query->get();
                $view = 'laporan.cetak-keluar';
            }

            else { // MUTASI
                $masukQuery = \App\Models\BarangMasuk::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->whereDate('created_at', $tanggal);

                $keluarQuery = \App\Models\BarangKeluar::with(['barang.kategori', 'unitBarang.lokasi'])
                    ->whereDate('created_at', $tanggal);

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
