<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: serif;
            text-align: center;
            padding: 60px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            margin-top: 40px;
            font-size: 16px;
        }
        .name {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            margin-top: 60px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="title">SERTIFIKAT KELULUSAN</div>

    <div class="content">
        Diberikan kepada:
        <div class="name">{{ $santri->user->name }}</div>

        Atas kelulusan pada subject:
        <strong>{{ $subject->nama }}</strong>
    </div>

    <div class="content">
        Dengan memenuhi seluruh syarat kehadiran dan nilai.
    </div>

    <div class="footer">
        {{ now()->format('d F Y') }}<br>
        <strong>Sekolah Islam Kebangsaan</strong>
    </div>

</body>
</html>
