<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Rekap Absensi Santri Per Subject</h2>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Subject</th>
            <th>Hadir</th>
            <th>Total</th>
            <th>%</th>
            <th>Status Ujian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rekap as $r)
        <tr>
            <td>{{ $r['nama'] }}</td>
            <td>{{ $r['subject'] }}</td>
            <td>{{ $r['hadir'] }}</td>
            <td>{{ $r['total'] }}</td>
            <td>{{ $r['persentase'] }}%</td>
            <td>{{ $r['status_ujian'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
