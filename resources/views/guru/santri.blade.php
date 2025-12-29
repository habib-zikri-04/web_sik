<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            <h1 class="text-2xl font-bold mb-6">Daftar Santri yang Diajar</h1>

            @if ($groups->isEmpty())
                <div class="bg-white p-6 rounded-lg text-gray-500">
                    Belum ada santri.
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($groups as $group)
                        @php
                            $jadwal = $group->first();
                            $kelas = $jadwal->kelas;
                        @endphp

                        <div class="bg-white rounded-xl border p-5">
                            <h2 class="font-semibold text-lg mb-1">
                                {{ $jadwal->subject->nama }}
                            </h2>

                            <p class="text-sm text-gray-600 mb-4">
                                Kelas: {{ $kelas->nama ?? 'Umum' }}
                            </p>

                            @if ($kelas && $kelas->santris->count())
                                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                                    @foreach ($kelas->santris as $santri)
                                        <li class="flex items-center gap-2 text-sm bg-gray-50 rounded-md px-3 py-2">
                                            <x-heroicon-o-user class="w-4 h-4 text-gray-500"/>
                                            {{ $santri->user->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500">
                                    Belum ada santri di kelas ini.
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
