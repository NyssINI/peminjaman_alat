<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
</head>
<body>
    <center>
        <h2>LAPORAN PEMINJAMAN ALAT</h2>
    </center>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr bgcolor="#f2f2f2">
                <th>No</th>
                <th>Peminjam</th>
                <th>Nama Alat</th>
                <th>Tgl Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td>{{ $item->nama_peminjam }}</td>
                <td>{{ $item->alat->nama_alat ?? '-' }}</td>
                <td align="center">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}</td>
                <td align="center">{{ strtoupper($item->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" align="center">Tidak ada data peminjaman pada tanggal tersebut.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html>