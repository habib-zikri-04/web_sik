<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat Kelulusan - {{ $subject->nama }}</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background: white;
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
        }
        
        .certificate-container {
            width: 297mm;
            height: 210mm;
            position: relative;
            background-image: url("{{ public_path('images/sertifikat-bg.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .content-area {
            position: absolute;
            top: 220px;
            left: 0;
            right: 0;
            text-align: center;
            width: 100%;
        }

        .given-to {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-style: italic;
        }

        .student-name {
            font-size: 48px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-family: 'Times New Roman', serif;
        }

        .divider {
            width: 400px;
            height: 2px;
            background: #8B4513; 
            margin: 0 auto 30px;
        }

        .description {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .subject-container {
            margin: 20px 0;
        }

        .subject-label {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .subject-name {
            font-size: 28px;
            font-weight: bold;
            color: #8B4513;
            text-transform: uppercase;
        }

        .status-badge {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 30px;
            background-color: #166534;
            color: white;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        .footer-area {
            position: absolute;
            bottom: 60px;
            left: 80px; /* Moved towards 1 (the left) */
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .signature-box {
            text-align: center;
        }

        .date-text {
            font-size: 15px;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .signature-title {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 70px; /* Space for physical signature */
        }

        .signature-name {
            font-size: 18px;
            font-weight: bold;
            color: #1a1a1a;
            text-decoration: underline;
        }

        .signature-nip {
            font-size: 15px;
            color: #1a1a1a;
            margin-top: 2px;
        }

        .cert-number {
            position: absolute;
            bottom: 20px;
            left: 50px;
            font-size: 9px;
            color: #444;
            font-family: 'Courier', monospace;
        }
    </style>
</head>
<body>

<div class="certificate-container">
    <div class="content-area">
        <p class="given-to">Sertifikat ini diberikan kepada:</p>
        <h1 class="student-name">{{ $santri->user->name }}</h1>
        <div class="divider"></div>
        
        <p class="description">
            Sebagai apresiasi atas keberhasilan menyelesaikan program pengajian mingguan<br>
            dan dinyatakan <strong>LULUS</strong> pada mata pelajaran:
        </p>

        <div class="subject-container">
            <h2 class="subject-name">{{ $subject->nama }}</h2>
        </div>

        <div class="status-badge">
            PRESTASI: LULUS DENGAN BAIK
        </div>
    </div>

    <!-- Signatures Section -->
    <div class="footer-area">
        <div class="signature-box">
            <p class="date-text">Padang, {{ now()->translatedFormat('d F Y') }}</p>
            <p class="signature-title">Dekan FST UIN Imam Bonjol Padang</p>
            <p class="signature-name">Prof. Dr. Ir. H. Rifki Ananda M.Si., P.hD</p>
            <p class="signature-nip">NIP. 197XXXXXXXXXXXXXXX</p>
        </div>
    </div>

    <div class="cert-number">
        Nomor Sertifikat: SIK/{{ date('Y') }}/{{ strtoupper($subject->kode) }}/{{ str_pad($santri->id, 4, '0', STR_PAD_LEFT) }}
    </div>
</div>

</body>
</html>
