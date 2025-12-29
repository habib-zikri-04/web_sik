<h3>Rekap Absensi Civitas </h3>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Subject</th>
            <th>Hadir</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rekap as $r)
            <tr>
                <td>{{ $r['nama'] }}</td>
                <td>{{ $r['subject'] }}</td>
                <td>{{ $r['hadir'] }}</td>
                <td>{{ $r['total'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
