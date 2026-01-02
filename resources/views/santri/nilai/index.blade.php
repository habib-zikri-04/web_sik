<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div style="margin-bottom: 1rem;">
                <a href="{{ route('santri.dashboard') }}" 
                   style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; font-size: 0.875rem;"
                   onmouseover="this.style.color='#374151';"
                   onmouseout="this.style.color='#6b7280';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Header -->
            <div style="background: linear-gradient(135deg, #166534 0%, #22c55e 100%); border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="font-size: 1.5rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Nilai & Feedback Saya</h1>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Lihat nilai dan download sertifikat kelulusan Anda</p>
                    </div>
                    <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                </div>
                <!-- Stats -->
                @php
                    $totalSubjects = count($data);
                    $lulusCount = collect($data)->where('lulus', true)->count();
                @endphp
                <div style="display: flex; gap: 2rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $totalSubjects }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Total Mata Pelajaran</p>
                    </div>
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $lulusCount }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Lulus & Dapat Sertifikat</p>
                    </div>
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $totalSubjects - $lulusCount }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Belum Lulus</p>
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            @if(count($data) > 0)
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                    @foreach ($data as $d)
                        @php
                            $isLulus = $d['lulus'];
                            $isMengaji = $d['type'] === 'mengaji';
                        @endphp
                        <div style="background-color: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid {{ $isLulus ? '#86efac' : '#fca5a5' }};">
                            <!-- Card Header -->
                            <div style="background: {{ $isLulus ? 'linear-gradient(135deg, #166534 0%, #22c55e 100%)' : 'linear-gradient(135deg, #991b1b 0%, #dc2626 100%)' }}; padding: 1rem;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <h3 style="font-size: 1rem; font-weight: 600; color: white;">{{ $d['subject']->nama }}</h3>
                                    <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.5rem; background-color: rgba(255,255,255,0.2); border-radius: 9999px; font-size: 0.6875rem; color: white; font-weight: 500;">
                                        {{ $isMengaji ? 'Kehadiran' : 'Nilai' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Card Body -->
                            <div style="padding: 1.25rem;">
                                @if ($isMengaji)
                                    <!-- Mengaji Type -->
                                    <div style="text-align: center; margin-bottom: 1rem;">
                                        <p style="font-size: 2.5rem; font-weight: bold; color: {{ $isLulus ? '#166534' : '#991b1b' }};">{{ $d['persen'] }}%</p>
                                        <p style="font-size: 0.8125rem; color: #6b7280;">Persentase Kehadiran</p>
                                    </div>
                                    <div style="background-color: #f3f4f6; border-radius: 0.5rem; padding: 0.75rem; margin-bottom: 1rem;">
                                        <div style="display: flex; justify-content: space-between; font-size: 0.8125rem; color: #6b7280;">
                                            <span>Hadir</span>
                                            <span style="font-weight: 600; color: #111827;">{{ $d['hadir'] }} / {{ $d['total'] }} pertemuan</span>
                                        </div>
                                    </div>
                                    <!-- Progress Bar -->
                                    <div style="margin-bottom: 1rem;">
                                        <div style="width: 100%; height: 0.5rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                            <div style="width: {{ $d['persen'] }}%; height: 100%; background-color: {{ $isLulus ? '#16a34a' : '#dc2626' }}; border-radius: 9999px;"></div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Nilai Type -->
                                    <div style="text-align: center; margin-bottom: 1rem;">
                                        <p style="font-size: 2.5rem; font-weight: bold; color: {{ $isLulus ? '#166534' : '#991b1b' }};">{{ $d['nilai'] }}</p>
                                        <p style="font-size: 0.8125rem; color: #6b7280;">Nilai Anda</p>
                                    </div>
                                    @if($d['feedback'])
                                        <div style="background-color: #f3f4f6; border-radius: 0.5rem; padding: 0.75rem; margin-bottom: 1rem;">
                                            <p style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Feedback dari Guru:</p>
                                            <p style="font-size: 0.8125rem; color: #374151; font-style: italic;">"{{ $d['feedback'] }}"</p>
                                        </div>
                                    @endif
                                    <!-- Progress Bar -->
                                    <div style="margin-bottom: 1rem;">
                                        <div style="width: 100%; height: 0.5rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                            <div style="width: {{ $d['nilai'] }}%; height: 100%; background-color: {{ $isLulus ? '#16a34a' : '#dc2626' }}; border-radius: 9999px;"></div>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Status & Action -->
                                <div style="border-top: 1px solid #e5e7eb; padding-top: 1rem;">
                                    @if ($isLulus)
                                        <div style="display: flex; align-items: center; justify-content: space-between;">
                                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; background-color: #dcfce7; color: #166534; font-size: 0.75rem; font-weight: 600; border-radius: 9999px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                LULUS
                                            </span>
                                            <div style="display: flex; gap: 0.5rem;">
                                                <a href="{{ route('santri.sertifikat', ['subject' => $d['subject']->id, 'stream' => 1]) }}" target="_blank"
                                                   style="display: inline-flex; align-items: center; padding: 0.5rem; background-color: #2563eb; color: white; border-radius: 0.5rem; text-decoration: none;"
                                                   title="Lihat Sertifikat">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('santri.sertifikat', $d['subject']->id) }}"
                                                   style="display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; background-color: #166534; color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none;"
                                                   onmouseover="this.style.backgroundColor='#15803d';"
                                                   onmouseout="this.style.backgroundColor='#166534';">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                    </svg>
                                                    Sertifikat
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div style="text-align: center;">
                                            <span style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background-color: #fee2e2; color: #991b1b; font-size: 0.75rem; font-weight: 500; border-radius: 9999px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                Belum memenuhi syarat (min. 80%)
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 4rem; text-align: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p style="font-size: 1rem; font-weight: 500; color: #6b7280;">Belum ada data nilai.</p>
                    <p style="font-size: 0.875rem; color: #9ca3af; margin-top: 0.25rem;">Nilai Anda akan muncul setelah guru menginput nilai.</p>
                </div>
            @endif

            <!-- Info Box -->
            <div style="margin-top: 1.5rem; background-color: #fef9c3; border: 1px solid #fde047; border-radius: 0.75rem; padding: 1rem;">
                <div style="display: flex; gap: 0.75rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #ca8a04; flex-shrink: 0; margin-top: 0.125rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p style="font-size: 0.875rem; font-weight: 600; color: #92400e;">Informasi Sertifikat</p>
                        <p style="font-size: 0.8125rem; color: #78350f; margin-top: 0.25rem;">
                            Sertifikat akan tersedia secara otomatis setelah nilai/kehadiran Anda mencapai minimal <strong>80%</strong>. 
                            Klik tombol "Download Sertifikat" untuk mengunduh sertifikat kelulusan Anda dalam format PDF.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
