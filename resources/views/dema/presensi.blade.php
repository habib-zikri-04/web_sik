<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div style="margin-bottom: 1rem;">
                <a href="{{ route('dema.dashboard') }}" 
                   style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; font-size: 0.875rem;"
                   onmouseover="this.style.color='#374151';"
                   onmouseout="this.style.color='#6b7280';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Header -->
            <div style="background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%); border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="font-size: 1.5rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Presensi Mengaji</h1>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Rekap kehadiran program mengaji Anda</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        @if($adaJadwalHariIni)
                            <a href="{{ route('presensi.scan') }}" 
                               style="display: inline-flex; align-items: center; background-color: white; color: #7c3aed; padding: 0.75rem 1.25rem; border-radius: 0.75rem; font-weight: bold; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s;"
                               onmouseover="this.style.transform='scale(1.05)';"
                               onmouseout="this.style.transform='scale(1)';"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                Scan QR Absen
                            </a>
                        @else
                            <div style="display: inline-flex; align-items: center; background-color: rgba(255,255,255,0.15); color: white; padding: 0.75rem 1.25rem; border-radius: 0.75rem; font-weight: bold; border: 1px solid rgba(255,255,255,0.3); cursor: not-allowed; opacity: 0.8;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Belum Terjadwal
                            </div>
                        @endif
                        <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div style="background-color: white; border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #7c3aed;">
                    <p style="font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Total Jadwal</p>
                    <p style="font-size: 1.75rem; font-weight: bold; color: #111827; margin-top: 0.25rem;">{{ $totalJadwal }}</p>
                </div>
                <div style="background-color: white; border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #a78bfa;">
                    <p style="font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Total Kehadiran</p>
                    <p style="font-size: 1.75rem; font-weight: bold; color: #111827; margin-top: 0.25rem;">{{ $totalHadir }}</p>
                </div>
            </div>



            <!-- Attendance List -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #ede9fe; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #7c3aed;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Riwayat Kehadiran</h2>
                            <p style="font-size: 0.75rem; color: #6b7280;">Daftar semua jadwal mengaji</p>
                        </div>
                    </div>
                </div>
                
                <div style="overflow-x: auto;">
                    @if($jadwals->count() > 0)
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #f9fafb;">
                                    <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal</th>
                                    <th style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Waktu</th>
                                    <th style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Ruangan</th>
                                    <th style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Pengajar</th>
                                    <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    @php
                                        $isHadir = in_array($jadwal->id, $myAttendance);
                                        $isPast = \Carbon\Carbon::parse($jadwal->tanggal)->isPast();
                                    @endphp
                                    <tr style="border-bottom: 1px solid #f3f4f6; {{ $loop->even ? 'background-color: #fafafa;' : '' }}">
                                        <td style="padding: 1rem 1.5rem;">
                                            <p style="font-size: 0.875rem; font-weight: 500; color: #111827;">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l') }}</p>
                                            <p style="font-size: 0.75rem; color: #6b7280;">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</p>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <span style="font-size: 0.875rem; color: #374151;">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</span>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <span style="font-size: 0.875rem; color: #374151;">{{ $jadwal->ruang ?? '-' }}</span>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <span style="font-size: 0.875rem; color: #374151;">{{ $jadwal->pengajar->nama ?? '-' }}</span>
                                        </td>
                                        <td style="padding: 1rem 1.5rem; text-align: center;">
                                            @if($isHadir)
                                                <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; background-color: #ede9fe; color: #7c3aed; font-size: 0.75rem; font-weight: 600; border-radius: 9999px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Hadir
                                                </span>
                                            @elseif($isPast)
                                                <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; background-color: #fee2e2; color: #991b1b; font-size: 0.75rem; font-weight: 500; border-radius: 9999px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Tidak Hadir
                                                </span>
                                            @else
                                                <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; background-color: #fef3c7; color: #92400e; font-size: 0.75rem; font-weight: 500; border-radius: 9999px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Belum
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div style="padding: 3rem; text-align: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p style="font-size: 0.875rem; color: #6b7280;">Belum ada jadwal mengaji.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Box -->
            <div style="margin-top: 1.5rem; background-color: #ede9fe; border: 1px solid #c4b5fd; border-radius: 0.75rem; padding: 1rem;">
                <div style="display: flex; gap: 0.75rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #7c3aed; flex-shrink: 0; margin-top: 0.125rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p style="font-size: 0.875rem; font-weight: 600; color: #5b21b6;">Cara Melakukan Presensi</p>
                        <p style="font-size: 0.8125rem; color: #5b21b6; margin-top: 0.25rem;">
                            Scan QR Code yang ditampilkan oleh Guru atau Admin saat kegiatan mengaji berlangsung. 
                            Presensi hanya dapat dilakukan pada saat jadwal mengaji aktif.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
