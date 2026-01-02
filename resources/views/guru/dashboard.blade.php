<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Selamat Datang, {{ Auth::user()->name }}!</h1>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Dashboard Guru - Kelola jadwal mengajar dan pantau kehadiran Anda.</p>
                    </div>
                    <div style="text-align: right;">
                        <p style="font-size: 0.875rem; color: #6b7280;">{{ now()->translatedFormat('l, d F Y') }}</p>
                        <p style="font-size: 0.75rem; color: #9ca3af;">{{ now()->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem;">
                <div style="background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ $jadwals->count() }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Mata Pelajaran</p>
                        </div>
                        <div style="width: 3rem; height: 3rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ $rekap->count() }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Total Kelas</p>
                        </div>
                        <div style="width: 3rem; height: 3rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            @php
                                $avgKehadiran = $rekap->count() > 0 ? round($rekap->avg('persen'), 1) : 0;
                            @endphp
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ $avgKehadiran }}%</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Rata-rata Kehadiran</p>
                        </div>
                        <div style="width: 3rem; height: 3rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Mengajar Section -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 2rem;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #dcfce7; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #16a34a;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Jadwal Mengajar</h2>
                            <p style="font-size: 0.75rem; color: #6b7280;">Daftar mata pelajaran yang Anda ajarkan</p>
                        </div>
                    </div>
                    @if($adaJadwalHariIni)
                        <a href="{{ route('presensi.scan') }}" 
                           style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #16a34a; color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s;"
                           onmouseover="this.style.transform='scale(1.05)';"
                           onmouseout="this.style.transform='scale(1)';"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Scan Absen SIK
                        </a>
                    @else
                        <div style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #f3f4f6; color: #9ca3af; font-size: 0.75rem; font-weight: 600; border-radius: 0.5rem; border: 1px solid #e5e7eb; cursor: not-allowed;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Belum Terjadwal
                        </div>
                    @endif
                </div>
                
                <div style="padding: 1.5rem;">
                    @if($jadwals->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                            @foreach ($jadwals as $group)
                                @php $jadwal = $group->first(); @endphp
                                <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; transition: all 0.2s;"
                                     onmouseover="this.style.borderColor='#16a34a'; this.style.boxShadow='0 4px 6px -1px rgba(22, 163, 74, 0.1)';"
                                     onmouseout="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                                    <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 0.75rem;">
                                        <h3 style="font-size: 1rem; font-weight: 600; color: #111827;">{{ $jadwal->subject->nama }}</h3>
                                        <span style="padding: 0.25rem 0.5rem; font-size: 0.6875rem; font-weight: 500; background-color: #dbeafe; color: #1d4ed8; border-radius: 9999px;">
                                            {{ $jadwal->kelas->nama ?? 'Umum' }}
                                        </span>
                                    </div>
                                    
                                    <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #6b7280;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #6b7280;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>{{ $jadwal->ruang ?? 'Ruangan belum ditentukan' }}</span>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('guru.nilai', $jadwal->id) }}"
                                       style="display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; background-color: #16a34a; color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.375rem; text-decoration: none; width: 100%; justify-content: center;"
                                       onmouseover="this.style.backgroundColor='#15803d';"
                                       onmouseout="this.style.backgroundColor='#16a34a';">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Input Nilai & Feedback
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="padding: 3rem; text-align: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p style="color: #6b7280;">Belum ada jadwal mengajar.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rekap Kehadiran Section -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- Rekap Kelas Reguler -->
                <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                    <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #fef3c7; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Rekap Kehadiran Mengajar</h2>
                            <p style="font-size: 0.75rem; color: #6b7280;">Statistik kehadiran per kelas reguler Anda</p>
                        </div>
                    </div>
                    
                    <div style="padding: 1.5rem;">
                        @if($rekap->count() > 0)
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                                @foreach ($rekap as $r)
                                    @php
                                        $persen = $r['persen'];
                                        $progressColor = $persen >= 80 ? '#16a34a' : ($persen >= 60 ? '#d97706' : '#dc2626');
                                        $bgColor = $persen >= 80 ? '#dcfce7' : ($persen >= 60 ? '#fef3c7' : '#fee2e2');
                                    @endphp
                                    <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem;">
                                        <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 0.75rem;">
                                            <div>
                                                <h3 style="font-size: 0.9375rem; font-weight: 600; color: #111827;">{{ $r['subject'] }}</h3>
                                                <p style="font-size: 0.8125rem; color: #6b7280;">{{ $r['kelas'] }}</p>
                                            </div>
                                            <div style="padding: 0.5rem 0.75rem; background-color: {{ $bgColor }}; border-radius: 0.5rem; text-align: center;">
                                                <p style="font-size: 1.25rem; font-weight: bold; color: {{ $progressColor }};">{{ $r['persen'] }}%</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Progress Bar -->
                                        <div style="margin-bottom: 0.75rem;">
                                            <div style="width: 100%; height: 0.5rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                                <div style="width: {{ $r['persen'] }}%; height: 100%; background-color: {{ $progressColor }}; border-radius: 9999px; transition: width 0.3s;"></div>
                                            </div>
                                        </div>
                                        
                                        <div style="display: flex; align-items: center; justify-content: space-between; font-size: 0.8125rem; color: #6b7280;">
                                            <span>Kehadiran</span>
                                            <span style="font-weight: 600; color: #374151;">{{ $r['hadir'] }} / {{ $r['total'] }} pertemuan</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="padding: 3rem; text-align: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <p style="color: #6b7280;">Belum ada data rekap kehadiran.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Rekap Khusus Mengaji -->
                @if($rekapMengaji)
                <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                    <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #f3e8ff; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #7e22ce;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Rekap Kehadiran Mengaji</h2>
                            <p style="font-size: 0.75rem; color: #6b7280;">Partisipasi Anda dalam Sesi Mengaji Bersama</p>
                        </div>
                    </div>
                    
                    <div style="padding: 1.5rem;">
                        <div style="background: linear-gradient(to right, #faf5ff, #ffffff); border: 1px solid #e9d5ff; border-radius: 1rem; padding: 1.5rem; max-width: 500px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                                <div>
                                    <p style="font-size: 0.8125rem; color: #7c3aed; font-weight: 600; text-transform: uppercase;">Kehadiran Anda</p>
                                    <p style="font-size: 1.5rem; font-weight: bold; color: #111827;">{{ $rekapMengaji['hadir'] }} / {{ $rekapMengaji['total'] }} <span style="font-size: 0.875rem; font-weight: normal; color: #6b7280;">Sesi</span></p>
                                </div>
                                <div style="width: 4.5rem; height: 4.5rem; background-color: #7e22ce; border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: white;">
                                    <p style="font-size: 1.25rem; font-weight: bold;">{{ $rekapMengaji['persen'] }}%</p>
                                </div>
                            </div>
                            
                            <div style="width: 100%; height: 0.75rem; background-color: #f3e8ff; border-radius: 9999px; overflow: hidden; margin-bottom: 0.5rem;">
                                <div style="width: {{ $rekapMengaji['persen'] }}%; height: 100%; background-color: #7e22ce; border-radius: 9999px; transition: width 0.5s;"></div>
                            </div>
                            <p style="font-size: 0.75rem; color: #6b7280;">Status kehadiran otomatis tercatat saat Anda melakukan scan mandiri.</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
