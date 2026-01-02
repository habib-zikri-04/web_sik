<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Assalamu'alaikum, {{ Auth::user()->name }}!</h1>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Dashboard Santri - Pantau jadwal dan kehadiran Anda.</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        @if($adaJadwalHariIni)
                            <a href="{{ route('presensi.scan') }}" 
                               style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background-color: #dc2626; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.2s;"
                               onmouseover="this.style.backgroundColor='#b91c1c'; this.style.transform='translateY(-2px)';"
                               onmouseout="this.style.backgroundColor='#dc2626'; this.style.transform='translateY(0)';"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                Scan Absen
                            </a>
                        @else
                            <div style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background-color: #f3f4f6; color: #9ca3af; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; border: 1px solid #e5e7eb; cursor: not-allowed;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                SIK Belum Buka
                            </div>
                        @endif
                        <div style="text-align: right;">
                            <p style="font-size: 0.875rem; color: #6b7280;">{{ now()->translatedFormat('l, d F Y') }}</p>
                            <p style="font-size: 0.75rem; color: #9ca3af;">{{ now()->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            @php
                $totalSubjects = $jadwals->count();
                $avgKehadiran = count($rekap) > 0 ? round(collect($rekap)->avg('persentase'), 1) : 0;
                $bolehUjian = collect($rekap)->where('status_ujian', 'Boleh Ujian')->count();
            @endphp
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
                <div style="background: linear-gradient(135deg, #991b1b 0%, #dc2626 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ $totalSubjects }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Jadwal Aktif</p>
                        </div>
                        <div style="width: 3rem; height: 3rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #166534 0%, #22c55e 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ $avgKehadiran }}%</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Rata-rata Kehadiran</p>
                        </div>
                        <div style="width: 3rem; height: 3rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #1e293b 0%, #475569 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ $bolehUjian }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Boleh Ujian</p>
                        </div>
                        <div style="width: 3rem; height: 3rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ count($rekap) }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Mata Pelajaran</p>
                        </div>
                        <div style="width: 3rem; height: 3rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Kegiatan Section -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 2rem;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; background-color: #fee2e2; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #991b1b;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Jadwal Kegiatan</h2>
                        <p style="font-size: 0.75rem; color: #6b7280;">Daftar jadwal kelas Anda hari ini</p>
                    </div>
                </div>
                
                <div style="padding: 1.5rem;">
                    @if($jadwals->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                            @foreach ($jadwals as $jadwal)
                                @php
                                    $colors = ['#991b1b', '#166534', '#1e293b', '#7c3aed'];
                                    $colorIndex = $loop->index % count($colors);
                                @endphp
                                <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden; transition: all 0.2s;"
                                     onmouseover="this.style.borderColor='{{ $colors[$colorIndex] }}'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';"
                                     onmouseout="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                                    <div style="background: {{ $colors[$colorIndex] }}; padding: 0.75rem 1rem;">
                                        <h3 style="font-size: 0.9375rem; font-weight: 600; color: white;">{{ $jadwal->subject->nama ?? 'Mengaji' }}</h3>
                                    </div>
                                    <div style="padding: 1rem;">
                                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                            @if ($jadwal->kelas)
                                                <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem; color: #6b7280;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span>{{ $jadwal->kelas->nama }}</span>
                                                </div>
                                            @endif
                                            <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem; color: #6b7280;">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</span>
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem; color: #6b7280;">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <span>{{ $jadwal->ruang ?? 'Aula' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="padding: 3rem; text-align: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p style="color: #6b7280;">Tidak ada jadwal kegiatan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rekap Kehadiran Section -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #dcfce7; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #166534;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Rekap Kehadiran</h2>
                            <p style="font-size: 0.75rem; color: #6b7280;">Statistik kehadiran per mata pelajaran</p>
                        </div>
                    </div>
                    <a href="{{ route('santri.nilai') }}"
                       style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #166534; color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none;"
                       onmouseover="this.style.backgroundColor='#15803d';"
                       onmouseout="this.style.backgroundColor='#166534';">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Lihat Nilai
                    </a>
                </div>
                
                <div style="padding: 1.5rem;">
                    @if(count($rekap) > 0)
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                            @foreach ($rekap as $item)
                                @php
                                    $persen = $item['persentase'];
                                    $progressColor = $persen >= 80 ? '#16a34a' : ($persen >= 60 ? '#d97706' : '#dc2626');
                                    $bgColor = $persen >= 80 ? '#dcfce7' : ($persen >= 60 ? '#fef3c7' : '#fee2e2');
                                    $statusBg = $item['status_ujian'] === 'Boleh Ujian' ? '#dcfce7' : '#fee2e2';
                                    $statusColor = $item['status_ujian'] === 'Boleh Ujian' ? '#166534' : '#991b1b';
                                @endphp
                                <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem;">
                                    <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1rem;">
                                        <div>
                                            <h3 style="font-size: 1rem; font-weight: 600; color: #111827;">{{ $item['subject'] }}</h3>
                                            <p style="font-size: 0.8125rem; color: #6b7280; margin-top: 0.25rem;">
                                                Hadir {{ $item['hadir'] }} dari {{ $item['total'] }} pertemuan
                                            </p>
                                        </div>
                                        <div style="padding: 0.5rem 0.75rem; background-color: {{ $bgColor }}; border-radius: 0.5rem; text-align: center;">
                                            <p style="font-size: 1.25rem; font-weight: bold; color: {{ $progressColor }};">{{ $persen }}%</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div style="margin-bottom: 1rem;">
                                        <div style="width: 100%; height: 0.5rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                            <div style="width: {{ $persen }}%; height: 100%; background-color: {{ $progressColor }}; border-radius: 9999px; transition: width 0.3s;"></div>
                                        </div>
                                    </div>
                                    
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <span style="font-size: 0.75rem; color: #6b7280;">Status Ujian</span>
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; background-color: {{ $statusBg }}; color: {{ $statusColor }}; font-size: 0.75rem; font-weight: 600; border-radius: 9999px;">
                                            @if($item['status_ujian'] === 'Boleh Ujian')
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                            {{ $item['status_ujian'] }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="padding: 3rem; text-align: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <p style="color: #6b7280;">Belum ada data kehadiran.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
