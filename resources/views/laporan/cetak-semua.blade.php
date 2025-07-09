<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Semua Data Inventaris</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        h3, h4, p {
            text-align: center;
            margin: 0;
        }
        h4 {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <h3>Laporan Semua Data Inventaris</h3>
    <p>Tanggal Cetak: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>

    {{-- Barang Masuk --}}
    <h4>Barang Masuk</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Kode Inventaris</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['masuk'] as $index => $masuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $masuk->barang->nama_brg ?? '-' }}</td>
                    <td>{{ $masuk->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $masuk->unitBarang->kode_inventaris ?? '-' }}</td>
                    <td>{{ $masuk->unitBarang->lokasi->nama_lokasi ?? '-' }}</td>
                    <td>{{ ucfirst($masuk->unitBarang->status ?? '-') }}</td>
                    <td>{{ optional($masuk->created_at)->format('d-m-Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align: center;">Tidak ada data barang masuk.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Barang Keluar --}}
    <h4>Barang Keluar</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Kode Inventaris</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Tanggal Keluar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['keluar'] as $index => $keluar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $keluar->barang->nama_brg ?? '-' }}</td>
                    <td>{{ $keluar->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $keluar->unitBarang->kode_inventaris ?? '-' }}</td>
                    <td>{{ $keluar->unitBarang->lokasi->nama_lokasi ?? '-' }}</td>
                    <td>{{ ucfirst($keluar->unitBarang->status ?? '-') }}</td>
                    <td>{{ optional($keluar->created_at)->format('d-m-Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align: center;">Tidak ada data barang keluar.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
