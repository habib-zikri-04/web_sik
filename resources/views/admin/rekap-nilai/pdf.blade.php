<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h3>Rekap Nilai & Feedback Santri</h3>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Subject</th>
            <th>Nilai</th>
            <th>Feedback</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($nilais as $n)
        <tr>
            <td>{{ $n->santri->user->name }}</td>
            <td>{{ $n->kelas->nama }}</td>
            <td>{{ $n->subject->nama }}</td>
            <td align="center">{{ $n->nilai ?? '-' }}</td>
            <td>{{ $n->feedback ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
