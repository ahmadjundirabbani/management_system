<h2>Laporan Karyawan</h2>
<table border="1" width="100%" style="border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Gaji</th>
        </tr>
    </thead>
    <tbody>
        @foreach($karyawan as $k)
        <tr>
            <td>{{ $k->Id }}</td>
            <td>{{ $k->Nama }}</td>
            <td>{{ number_format($k->Gaji, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>