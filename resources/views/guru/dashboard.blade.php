<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            <h1 class="text-2xl font-bold mb-1">Dashboard Guru</h1>

            <h2 class="text-lg font-semibold mb-4">Jadwal Mengajar</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($jadwals as $group)
        @php $jadwal = $group->first(); @endphp

        <div class="bg-white rounded-xl border shadow-sm p-5">
            <h3 class="text-base font-semibold text-gray-800 mb-3">
                {{ $jadwal->subject->nama }}
            </h3>

            <div class="space-y-2 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-users class="w-4 h-4 text-gray-400"/>
                    <span>{{ $jadwal->kelas->nama ?? 'Umum' }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <x-heroicon-o-clock class="w-4 h-4 text-gray-400"/>
                    <span>{{ $jadwal->jam_mulai }} – {{ $jadwal->jam_selesai }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <x-heroicon-o-map-pin class="w-4 h-4 text-gray-400"/>
                    <span>{{ $jadwal->ruang }}</span>
                </div>
                <a href="{{ route('guru.nilai', $jadwal->id) }}"
   class="inline-block mt-3 text-sm text-lime-900 hover:underline">
    Input Nilai & Feedback →
</a>
            </div>
        </div>
    @endforeach


</div>



    <h2 class="text-lg font-semibold mt-10 mb-4">Rekap Kehadiran</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($rekap as $r)
            <div class="bg-white rounded-xl border shadow-sm p-5">
                <h3 class="text-base font-semibold text-gray-800 mb-1">
                    {{ $r['subject'] }}
                </h3>

                <p class="text-sm text-gray-500 mb-3">
                    {{ $r['kelas'] }}
                </p>

                <div class="flex items-end justify-between">
                    <div class="text-sm text-gray-600">
                        Hadir<br>
                        <span class="font-medium">
                            {{ $r['hadir'] }} / {{ $r['total'] }}
                        </span>
                    </div>

                    <div class="text-right">
                        <div class="text-xl font-bold text-gray-800">
                            {{ $r['persen'] }}%
                        </div>
                        <div class="text-xs text-gray-500">
                            Kehadiran
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    </div>

        </div>

    </div>
</x-app-layout>
