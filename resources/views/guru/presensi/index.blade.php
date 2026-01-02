<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Presensi – QR Code Kelas Saya</h1>

            @if (isset($error))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    {{ $error }}
                </div>
            @endif

            @if ($jadwalAktif->count())
                <h2 class="text-lg font-semibold mb-4">Sesi Aktif Sekarang</h2>

                @foreach ($jadwalAktif as $jadwal)
                    <div class="mb-6 bg-white rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-gray-700 mb-4">
                            <span class="font-semibold">
                                {{ $jadwal->nama_sesi ?? 'Sesi ' . $jadwal->sesi }}
                            </span><br>

                            Kelas:
                            <span class="font-semibold">{{ $jadwal->kelas->nama ?? '-' }}</span><br>

                            Mata Pelajaran:
                            <span class="font-semibold">{{ $jadwal->subject->nama ?? '-' }}</span><br>

                            Waktu:
                            <span class="font-semibold">
                                {{ $jadwal->jam_mulai }} – {{ $jadwal->jam_selesai }}
                            </span>
                        </p>

                        <div class="flex flex-col items-center">
                            {{-- Container QR dengan ID unik untuk auto-refresh --}}
                            <div id="qr-container-{{ $jadwal->id }}" class="bg-white p-4 rounded-2xl shadow" data-jadwal-id="{{ $jadwal->id }}">
                                {!! $qrs[$jadwal->id] !!}
                            </div>

                            {{-- Timer Countdown --}}
                            <p id="timer-{{ $jadwal->id }}" class="mt-2 text-xs font-mono text-red-500">
                                Refresh in: 10:00
                            </p>

                            <p class="mt-3 text-xs text-gray-500 text-center">
                                Scan QR ini untuk presensi sesi ini
                            </p>
                        </div>
                    </div>
                @endforeach

                <p class="text-xs text-gray-500 text-center">
                    Waktu sekarang: {{ $now->format('d M Y H:i') }}
                </p>
            @else
                <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Sesi Aktif</h2>
                    <p class="text-gray-600">
                        Tidak ada jadwal mengajar Anda yang aktif pada waktu sekarang. Admin dapat mengatur jadwal Anda pada hari apa pun melalui panel kontrol.
                    </p>
                </div>
            @endif

        </div>
    </div>

    {{-- Script untuk Auto-Refresh QR Code --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qrContainers = document.querySelectorAll('[data-jadwal-id]');

            qrContainers.forEach(container => {
                const jadwalId = container.dataset.jadwalId;
                const timerElement = document.getElementById(`timer-${jadwalId}`);
                let timeLeft = 600; // 10 menit (detik)

                // Fungsi hitung mundur tampilan
                setInterval(() => {
                    if (timeLeft > 0) {
                        timeLeft--;
                        const m = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                        const s = (timeLeft % 60).toString().padStart(2, '0');
                        if (timerElement) timerElement.innerText = `Refresh in: ${m}:${s}`;
                    }
                }, 1000);

                // Fungsi refresh QR dari server setiap 10 menit
                setInterval(() => {
                    fetch(`/guru/presensi/qr/${jadwalId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Update QR Code SVG
                            container.innerHTML = data.qr_code;
                            // Reset timer
                            timeLeft = 600; 
                            console.log(`QR Code for Jadwal ${jadwalId} refreshed.`);
                        })
                        .catch(err => console.error('Gagal refresh QR:', err));
                }, 600000); // 10 menit (600,000 ms)
            });
        });
    </script>
</x-app-layout>
