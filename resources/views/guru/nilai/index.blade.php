<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
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
            <div style="background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%); border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="font-size: 1.5rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Nilai & Feedback</h1>
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-top: 0.5rem;">
                            <span style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background-color: rgba(255,255,255,0.2); border-radius: 9999px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: white; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span style="font-size: 0.875rem; font-weight: 500; color: white;">{{ $subject->nama }}</span>
                            </span>
                            <span style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background-color: rgba(255,255,255,0.2); border-radius: 9999px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: white; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span style="font-size: 0.875rem; font-weight: 500; color: white;">{{ $kelas->nama }}</span>
                            </span>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Stats -->
                <div style="display: flex; gap: 1.5rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $santris->count() }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Total Santri</p>
                    </div>
                    @php
                        $sudahDinilai = $santris->filter(fn($s) => $s->nilai->first())->count();
                    @endphp
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $sudahDinilai }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Sudah Dinilai</p>
                    </div>
                    <div>
                        <p style="font-size: 1.5rem; font-weight: bold; color: white;">{{ $santris->count() - $sudahDinilai }}</p>
                        <p style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Belum Dinilai</p>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Santri List -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; background-color: #dcfce7; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #16a34a;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Daftar Santri</h2>
                        <p style="font-size: 0.75rem; color: #6b7280;">Input nilai dan feedback untuk setiap santri</p>
                    </div>
                </div>

                <div style="padding: 0;">
                    @forelse ($santris as $index => $santri)
                        @php
                            $nilai = $santri->nilai->first();
                            $hasNilai = $nilai && $nilai->nilai;
                            $nilaiValue = $nilai->nilai ?? null;
                            $nilaiColor = $hasNilai ? ($nilaiValue >= 80 ? '#16a34a' : ($nilaiValue >= 60 ? '#d97706' : '#dc2626')) : '#9ca3af';
                            $nilaiBg = $hasNilai ? ($nilaiValue >= 80 ? '#dcfce7' : ($nilaiValue >= 60 ? '#fef3c7' : '#fee2e2')) : '#f3f4f6';
                        @endphp

                        <form method="POST" action="{{ route('guru.nilai.store') }}" 
                              style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6; {{ $index % 2 === 0 ? 'background-color: #fafafa;' : '' }}">
                            @csrf
                            <input type="hidden" name="santri_id" value="{{ $santri->id }}">
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

                            <div style="display: flex; align-items: flex-start; gap: 1rem;">
                                <!-- Avatar & Name -->
                                <div style="display: flex; align-items: center; gap: 0.75rem; min-width: 200px;">
                                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <span style="font-size: 0.875rem; font-weight: 600; color: white;">{{ strtoupper(substr($santri->user->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p style="font-size: 0.9375rem; font-weight: 600; color: #111827;">{{ $santri->user->name }}</p>
                                        <p style="font-size: 0.75rem; color: #6b7280;">{{ $santri->user->email }}</p>
                                    </div>
                                </div>

                                <!-- Nilai Input -->
                                <div style="width: 100px; flex-shrink: 0;">
                                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                        Nilai
                                    </label>
                                    <input type="number" name="nilai" min="0" max="100" 
                                           value="{{ $nilai->nilai ?? '' }}"
                                           style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9375rem; font-weight: 600; text-align: center; outline: none; transition: all 0.2s;"
                                           onfocus="this.style.borderColor='#16a34a'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)';"
                                           onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                           placeholder="0-100">
                                </div>

                                <!-- Feedback Input -->
                                <div style="flex: 1;">
                                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                        Feedback
                                    </label>
                                    <textarea name="feedback" rows="2"
                                              style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; resize: none; transition: all 0.2s;"
                                              onfocus="this.style.borderColor='#16a34a'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)';"
                                              onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                              placeholder="Tulis feedback untuk santri...">{{ $nilai->feedback ?? '' }}</textarea>
                                </div>

                                <!-- Status & Action -->
                                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 0.5rem;">
                                    @if($hasNilai)
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; background-color: {{ $nilaiBg }}; color: {{ $nilaiColor }}; font-size: 0.75rem; font-weight: 600; border-radius: 9999px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $nilaiValue }}
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; background-color: #f3f4f6; color: #6b7280; font-size: 0.75rem; font-weight: 500; border-radius: 9999px;">
                                            Belum dinilai
                                        </span>
                                    @endif

                                    <button type="submit"
                                            style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #16a34a; color: white; font-size: 0.75rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;"
                                            onmouseover="this.style.backgroundColor='#15803d';"
                                            onmouseout="this.style.backgroundColor='#16a34a';">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    @empty
                        <div style="padding: 3rem; text-align: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p style="font-size: 0.875rem; color: #6b7280;">Belum ada santri di kelas ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
