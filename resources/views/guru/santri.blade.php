<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div style="margin-bottom: 1rem;">
                <a href="{{ route('guru.dashboard') }}" 
                   style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; font-size: 0.875rem;"
                   onmouseover="this.style.color='#374151';"
                   onmouseout="this.style.color='#6b7280';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Header Card -->
            <div style="background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%); border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="font-size: 1.5rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Daftar Santri yang Diajar</h1>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Lihat semua santri berdasarkan kelas yang Anda ajar</p>
                    </div>
                    <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <!-- Stats -->
                <div style="display: flex; gap: 2rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $groups->count() }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Total Kelas</p>
                    </div>
                    @php
                        $totalSantri = $groups->sum(fn($g) => $g->first()->kelas?->santris?->count() ?? 0);
                    @endphp
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $totalSantri }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Total Santri</p>
                    </div>
                </div>
            </div>

            @if ($groups->isEmpty())
                <!-- Empty State -->
                <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 4rem; text-align: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p style="font-size: 1rem; font-weight: 500; color: #6b7280;">Belum ada santri yang diajar.</p>
                    <p style="font-size: 0.875rem; color: #9ca3af; margin-top: 0.25rem;">Jadwal mengajar Anda belum memiliki kelas dengan santri.</p>
                </div>
            @else
                <!-- Class Groups -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($groups as $group)
                        @php
                            $jadwal = $group->first();
                            $kelas = $jadwal->kelas;
                            $santris = $kelas?->santris ?? collect();
                            $colorSets = [
                                ['bg' => 'linear-gradient(135deg, #991b1b 0%, #dc2626 100%)', 'solid' => '#991b1b'],
                                ['bg' => 'linear-gradient(135deg, #166534 0%, #22c55e 100%)', 'solid' => '#166534'],
                                ['bg' => 'linear-gradient(135deg, #1e293b 0%, #475569 100%)', 'solid' => '#334155'],
                            ];
                            $colorIndex = $loop->index % count($colorSets);
                            $currentColor = $colorSets[$colorIndex];
                        @endphp

                        <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                            <!-- Class Header -->
                            <div style="background: {{ $currentColor['bg'] }}; padding: 1.25rem 1.5rem;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div>
                                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.375rem;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            <h2 style="font-size: 1.125rem; font-weight: 600; color: white;">{{ $jadwal->subject->nama }}</h2>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; background-color: rgba(255,255,255,0.2); border-radius: 9999px; font-size: 0.75rem; color: white;">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                                {{ $kelas->nama ?? 'Umum' }}
                                            </span>
                                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; background-color: rgba(255,255,255,0.2); border-radius: 9999px; font-size: 0.75rem; color: white;">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $santris->count() }} Santri
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('guru.nilai', $jadwal->id) }}"
                                       style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: rgba(255,255,255,0.2); color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none;"
                                       onmouseover="this.style.backgroundColor='rgba(255,255,255,0.3)';"
                                       onmouseout="this.style.backgroundColor='rgba(255,255,255,0.2)';">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Input Nilai
                                    </a>
                                </div>
                            </div>

                            <!-- Santri List -->
                            <div style="padding: 1.25rem 1.5rem;">
                                @if ($santris->count())
                                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem;">
                                        @foreach ($santris as $santri)
                                            <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background-color: #f9fafb; border-radius: 0.5rem; border: 1px solid #e5e7eb; transition: all 0.2s;"
                                                 onmouseover="this.style.borderColor='{{ $currentColor['solid'] }}'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';"
                                                 onmouseout="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                                                <div style="width: 2.25rem; height: 2.25rem; border-radius: 50%; background: {{ $currentColor['solid'] }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                    <span style="font-size: 0.75rem; font-weight: 600; color: white;">{{ strtoupper(substr($santri->user->name, 0, 1)) }}</span>
                                                </div>
                                                <div style="min-width: 0;">
                                                    <p style="font-size: 0.875rem; font-weight: 500; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $santri->user->name }}</p>
                                                    <p style="font-size: 0.6875rem; color: #6b7280;">{{ $santri->jenis_kelamin === 'L' ? 'Laki-laki' : ($santri->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div style="padding: 2rem; text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 2.5rem; height: 2.5rem; color: #d1d5db; margin: 0 auto 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        <p style="font-size: 0.875rem; color: #6b7280;">Belum ada santri di kelas ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
