<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.jadwal.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Jadwal
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Detail Jadwal & QR Code</h1>
                    <a href="{{ route('admin.jadwal.edit', $jadwal) }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                        Edit Jadwal
                    </a>
                </div>

                <!-- Jadwal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $jadwal->kelas->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Mata Pelajaran</p>
                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $jadwal->subject->nama ?? '-' }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Guru Pengajar</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $jadwal->pengajar->nama ?? 'Bersama-sama' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pelaksanaan</p>
                            <div class="flex items-center gap-2">
                                <p class="text-lg font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}
                                </p>
                                @if(\Carbon\Carbon::parse($jadwal->tanggal)->isToday())
                                    <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded uppercase">Hari Ini</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Input Sistem</p>
                            <p class="text-base text-gray-700">
                                {{ $jadwal->created_at->translatedFormat('d F Y') }} <span class="text-gray-400 text-sm">({{ $jadwal->created_at->format('H:i') }} WIB)</span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Waktu & Ruang</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }} WIB
                            </p>
                            <p class="text-sm text-gray-600">{{ $jadwal->ruang ?? 'Ruang belum ditentukan' }}</p>
                        </div>
                    </div>
                    </div>
                </div>

                <hr class="my-6">

                <!-- QR Code Section -->
                <div class="text-center">
                    <h2 class="text-lg font-semibold mb-4">QR Code Absensi</h2>
                    
                    <div id="qr-container" class="inline-block bg-white p-6 rounded-2xl shadow-lg border-2 border-gray-100" data-jadwal-id="{{ $jadwal->id }}">
                        {!! $qrCode !!}
                    </div>

                    <p id="timer" class="mt-4 text-sm font-mono text-red-500">
                        QR Code berlaku: 10:00
                    </p>

                    <p class="mt-2 text-xs text-gray-500">
                        QR Code akan refresh otomatis setiap 10 menit untuk keamanan.
                    </p>

                    <div class="mt-6">
                        <button onclick="refreshQR()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                            🔄 Refresh QR Code Sekarang
                        </button>
                    </div>

                    @if(!\Carbon\Carbon::parse($jadwal->tanggal)->isToday())
                        <div class="mt-4 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-700 flex items-start gap-3 text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <p class="font-bold">Akses QR Belum Dibuka</p>
                                <p>QR ini hanya dapat di-scan oleh santri/user pada tanggal pelaksanaan yang dijadwalkan (<strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}</strong>). Saat ini akses masih terkunci.</p>
                            </div>
                        </div>
                    @else
                        <div class="mt-4 p-4 bg-green-50 border border-green-100 rounded-xl text-sm text-green-700 flex items-start gap-3 text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-bold">QR Siap Digunakan</p>
                                <p>Hari ini adalah jadwal pelaksanaan. Santri dapat melakukan scan pada QR Code ini sekarang.</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="mt-6 p-4 bg-yellow-50 rounded-lg text-sm text-yellow-700">
                        <strong>Instruksi:</strong> Tampilkan QR Code ini di layar agar santri dapat scan untuk melakukan absensi.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const jadwalId = {{ $jadwal->id }};
        let timeLeft = 600; // 10 minutes

        // Countdown timer
        setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                const m = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                const s = (timeLeft % 60).toString().padStart(2, '0');
                document.getElementById('timer').innerText = `QR Code berlaku: ${m}:${s}`;
            }
        }, 1000);

        // Auto-refresh QR every 10 minutes
        setInterval(() => {
            refreshQR();
        }, 600000);

        function refreshQR() {
            fetch(`/admin/presensi/qr/${jadwalId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('qr-container').innerHTML = data.qr_code;
                    timeLeft = 600;
                    console.log('QR Code refreshed');
                })
                .catch(err => console.error('Failed to refresh QR:', err));
        }
    </script>
</x-app-layout>
