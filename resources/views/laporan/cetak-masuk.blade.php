<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>
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
        .status-badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: capitalize;
        }
        .bg-success {
            background-color: #d4edda;
            color: #155724;
        }
        .bg-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .bg-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <h3>Laporan Barang Masuk</h3>
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
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $masuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $masuk->barang->nama_brg ?? '-' }}</td>
                    <td>{{ $masuk->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $masuk->unitBarang->kode_inventaris ?? '-' }}</td>
                    <td>{{ $masuk->unitBarang->lokasi->nama_lokasi ?? '-' }}</td>
                    <td>
                        @php
                            $status = $masuk->unitBarang->status ?? '-';
                            $warna = match($status) {
                                'rusak' => 'bg-danger',
                                'dipinjam' => 'bg-warning',
                                default => 'bg-success'
                            };
                        @endphp
                        <span class="status-badge {{ $warna }}">{{ ucfirst($status) }}</span>
                    </td>
                    <td>{{ optional($masuk->unitBarang->created_at)->format('d-m-Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data barang masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
