<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold mb-6">Presensi – QR Code</h1>

            @if ($jadwalAktif->count())
    <h2 class="text-lg font-semibold mb-4">Sesi Aktif Sekarang</h2>

    @foreach ($jadwalAktif as $jadwal)
        <div class="mb-6 bg-white rounded-2xl shadow-sm p-6">
            <p class="text-sm text-gray-700 mb-4">
                <span class="font-semibold">
                    {{ $jadwal->nama_sesi ?? 'Sesi ' . $jadwal->sesi }}
                </span><br>

                Mata Pelajaran:
                <span class="font-semibold">{{ $jadwal->subject->nama ?? '-' }}</span><br>

                Pengajar:
                <span class="font-semibold">{{ $jadwal->pengajar->nama ?? 'Bersama-sama' }}</span><br>

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

                {{-- Timer Countdown (Optional) --}}
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
    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
        <h2 class="text-lg font-semibold mb-2">Tidak ada sesi presensi yang aktif</h2>
        <p class="text-sm text-gray-600">
            Sistem tidak menemukan jadwal yang cocok dengan waktu sekarang.
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
                    fetch(`/admin/presensi/qr/${jadwalId}`)
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
