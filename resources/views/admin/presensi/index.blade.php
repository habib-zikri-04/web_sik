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
                <span class="font-semibold">{{ $jadwal->pengajar->nama ?? '-' }}</span><br>

                Waktu:
                <span class="font-semibold">
                    {{ $jadwal->jam_mulai }} – {{ $jadwal->jam_selesai }}
                </span>
            </p>

            <div class="flex flex-col items-center">
                <div class="bg-white p-4 rounded-2xl shadow">
                    {!! $qrs[$jadwal->id] !!}
                </div>

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
</x-app-layout>
