<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Keluar</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        h3 {
            text-align: center;
            margin-bottom: 5px;
        }
        p {
            text-align: center;
            margin-top: 0;
            font-size: 11px;
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
        .badge-rusak {
            background-color: #f8d7da;
            color: #721c24;
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h3>Laporan Barang Keluar (Rusak)</h3>
    <p>Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>

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
            @forelse ($data as $index => $unit)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $unit->barang->nama_brg ?? '-' }}</td>
                    <td>{{ $unit->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $unit->unitBarang->kode_inventaris ?? '-' }}</td>
                    <td>{{ $unit->unitBarang->lokasi->nama_lokasi ?? '-' }}</td>
                    <td>Rusak</td>
                    <td>{{ optional($unit->created_at)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data barang keluar (rusak).</td>
                </tr>
            @endforelse

        </tbody>
    </table>

</body>
</html>
