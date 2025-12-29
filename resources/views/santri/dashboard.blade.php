<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-2xl font-bold mb-6">Dashboard Santri</h1>
            <h2 class="text-lg font-semibold mb-4 text-gray-700">
                Jadwal Kegiatan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($jadwals as $jadwal)
                    <div class="bg-white rounded-lg shadow p-5 h-full">

                        {{-- Subject --}}
                        <div class="flex items-center gap-2 mb-3">
                            <x-heroicon-o-academic-cap class="w-5 h-5 text-gray-500" />
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $jadwal->subject->nama ?? 'Mengaji' }}
                            </h3>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600">
                            {{-- Kelas --}}
                            @if ($jadwal->kelas)
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-users class="w-4 h-4 text-gray-400" />
                                    <span>{{ $jadwal->kelas->nama }}</span>
                                </div>
                            @endif

                            {{-- Jam --}}
                            <div class="flex items-center gap-2">
                                <x-heroicon-o-clock class="w-4 h-4 text-gray-400" />
                                <span>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                            </div>

                            {{-- Ruangan --}}
                            <div class="flex items-center gap-2">
                                <x-heroicon-o-map-pin class="w-4 h-4 text-gray-400" />
                                <span>{{ $jadwal->ruang ?? 'Aula' }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Tidak ada jadwal.</p>
                @endforelse
            </div>

            <div class="mt-10">
    <h2 class="text-xl font-semibold mb-4">Rekap Kehadiran</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ($rekap as $item)
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold text-lg">
                {{ $item['subject'] }}
            </h3>

            <p class="text-sm text-gray-700">
                Hadir: {{ $item['hadir'] }} / {{ $item['total'] }}
            </p>

            <p class="text-sm text-gray-700">
                Persentase: {{ $item['persentase'] }}%
            </p>

            <span class="inline-block mt-2 px-3 py-1 text-sm rounded
                {{ $item['status_ujian'] === 'Boleh Ujian'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-red-100 text-red-700' }}">
                {{ $item['status_ujian'] }}
            </span>
        </div>
    @endforeach
</div>




        </div>
    </div>
</x-app-layout>
