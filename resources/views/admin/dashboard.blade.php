<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

            {{-- Kartu statistik atas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                {{-- Total Santri --}}
                <div class="bg-white rounded-2xl shadow-sm px-6 py-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Total Santri</p>
                        <p class="mt-2 text-2xl font-semibold text-red-600">
                            {{ $totalSantri ?? 0 }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-red-600 flex items-center justify-center text-white">
                        {{-- icon orang --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.25 18.75a6.75 6.75 0 0113.5 0M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Total Guru --}}
                <div class="bg-white rounded-2xl shadow-sm px-6 py-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Total Guru</p>
                        <p class="mt-2 text-2xl font-semibold text-emerald-700">
                            {{ $totalGuru ?? 0 }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-700 flex items-center justify-center text-white">
                        {{-- icon toga --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7l9-4 9 4-9 4-9-4z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7.5 10.5v4.75A2.75 2.75 0 0010.25 18h3.5A2.75 2.75 0 0016.5 15.25V10.5" />
                        </svg>
                    </div>
                </div>

                {{-- Civitas & Ormawa --}}
                <div class="bg-white rounded-2xl shadow-sm px-6 py-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Total Civitas &amp; Ormawa</p>
                        <p class="mt-2 text-2xl font-semibold text-slate-800">
                            {{ $totalCivitas ?? 0 }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-slate-800 flex items-center justify-center text-white">
                        {{-- icon buku --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 5.25A2.25 2.25 0 016 3h4.5a2.25 2.25 0 012.25 2.25V19.5A1.5 1.5 0 0111.25 21H6A2.25 2.25 0 013.75 18.75V5.25zM14.25 5.25A2.25 2.25 0 0116.5 3H21a.75.75 0 01.75.75v14.25A2.25 2.25 0 0119.5 21h-4.5A1.5 1.5 0 0113.5 19.5V5.25z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- konten lain dashboard admin di bawah sini --}}

            {{-- GRID BAWAH: JADWAL & PERSENTASE --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                {{-- JADWAL KEGIATAN --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 3v2M16 3v2M4 9h16M6 5h12a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2z" />
                        </svg>
                        <h2 class="text-base font-semibold text-slate-900">Jadwal Kegiatan</h2>
                    </div>

                    <div class="space-y-4 text-sm">
                        @foreach ($jadwal as $item)
                            <div class="flex">
                                <div>
                                    <div class="font-semibold text-slate-900">{{ $item['judul'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $item['waktu'] }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $item['keterangan'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- PERSENTASE KEHADIRAN --}}
                @php
                    $persen = $persentaseKehadiran ?? 0;
                @endphp

                <div class="bg-white rounded-2xl shadow-sm p-6 flex flex-col items-center justify-center">
                    <div class="flex items-center gap-2 self-start mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 17l6-6 4 4 7-10" />
                        </svg>
                        <h2 class="text-base font-semibold text-slate-900">Persentase Kehadiran</h2>
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="relative w-40 h-40 rounded-full border-[12px] border-red-600 flex items-center justify-center mb-3">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-red-600">
                                    {{ $persentaseKehadiran }}%
                                </div>
                                <div class="text-xs text-gray-500 mt-1">Minggu Ini</div>
                            </div>
                        </div>



                        {{-- opsional: tampilkan breakdown --}}
                        <div class="mt-4 text-xs text-gray-500 space-y-1 text-left">
                            <div>Data diambil dari kehadiran <span class="font-semibold">Santri, Guru, dan Civitas</span> minggu ini.</div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</x-app-layout>
