<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div style="margin-bottom: 1.5rem;">
                <a href="{{ route('admin.kelas.index') }}" 
                   style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; font-size: 0.875rem;"
                   onmouseover="this.style.color='#374151';"
                   onmouseout="this.style.color='#6b7280';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Kelas
                </a>
            </div>

            <!-- Header Card -->
            <div style="background: linear-gradient(135deg, #991b1b 0%, #dc2626 50%, #991b1b 100%); border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 4rem; height: 4rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h1 style="font-size: 1.75rem; font-weight: bold; color: white;">{{ $kela->nama }}</h1>
                            @if($kela->kode)
                                <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-top: 0.25rem;">Kode: {{ $kela->kode }}</p>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('admin.kelas.edit', $kela) }}"
                       style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background-color: white; color: #991b1b; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Kelas
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div style="background-color: white; border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #dc2626;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 2rem; font-weight: bold; color: #dc2626;">{{ $kela->santris->count() }}</p>
                            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">Total Santri</p>
                        </div>
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #fee2e2; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #dc2626;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background-color: white; border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #2563eb;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 2rem; font-weight: bold; color: #2563eb;">{{ $kela->santris->where('jenis_kelamin', 'L')->count() }}</p>
                            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">Laki-laki</p>
                        </div>
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #dbeafe; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #2563eb;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background-color: white; border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #db2777;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 2rem; font-weight: bold; color: #db2777;">{{ $kela->santris->where('jenis_kelamin', 'P')->count() }}</p>
                            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">Perempuan</p>
                        </div>
                        <div style="width: 2.5rem; height: 2.5rem; background-color: #fce7f3; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #db2777;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guru Mengajar Section -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 2rem; height: 2rem; background-color: #dcfce7; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #16a34a;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Guru Mengajar di Kelas Ini</h2>
                    <span style="padding: 0.25rem 0.5rem; background-color: #dcfce7; color: #16a34a; font-size: 0.75rem; font-weight: 600; border-radius: 9999px;">{{ $pengajarsMengajar->count() }}</span>
                </div>
                
                @if($pengajarsMengajar->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; padding: 1.5rem;">
                        @foreach($pengajarsMengajar as $item)
                            <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: linear-gradient(135deg, #16a34a, #4ade80); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.875rem;">
                                        {{ strtoupper(substr($item['pengajar']->nama, 0, 1)) }}
                                    </div>
                                    <p style="font-size: 0.875rem; font-weight: 600; color: #111827;">{{ $item['pengajar']->nama }}</p>
                                </div>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
                                    @foreach($item['subjects'] as $subject)
                                        <span style="padding: 0.25rem 0.5rem; font-size: 0.6875rem; font-weight: 500; background-color: #dbeafe; color: #1d4ed8; border-radius: 9999px;">
                                            {{ $subject }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="padding: 2rem; text-align: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin: 0 auto 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p style="color: #6b7280;">Belum ada jadwal mengajar untuk kelas ini.</p>
                    </div>
                @endif
            </div>

            <!-- Daftar Santri Section -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 2rem; height: 2rem; background-color: #fee2e2; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #dc2626;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Daftar Santri</h2>
                    <span style="padding: 0.25rem 0.5rem; background-color: #fee2e2; color: #dc2626; font-size: 0.75rem; font-weight: 600; border-radius: 9999px;">{{ $kela->santris->count() }}</span>
                </div>
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; width: 60px;">No</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Nama</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Email</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">No. HP</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kela->santris as $index => $santri)
                                <tr style="border-bottom: 1px solid #f3f4f6; {{ $index % 2 == 1 ? 'background-color: #f9fafb;' : 'background-color: white;' }}">
                                    <td style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.875rem; color: #6b7280;">
                                        {{ $index + 1 }}
                                    </td>
                                    <td style="padding: 0.875rem 1.5rem;">
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            @php
                                                $avatarBg = $santri->jenis_kelamin === 'L' 
                                                    ? 'linear-gradient(135deg, #2563eb, #60a5fa)' 
                                                    : 'linear-gradient(135deg, #db2777, #f472b6)';
                                            @endphp
                                            <div style="width: 2rem; height: 2rem; border-radius: 50%; background: {{ $avatarBg }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.75rem;">
                                                {{ strtoupper(substr($santri->nama, 0, 1)) }}
                                            </div>
                                            <span style="font-size: 0.875rem; font-weight: 500; color: #111827;">{{ $santri->nama }}</span>
                                        </div>
                                    </td>
                                    <td style="padding: 0.875rem 1.5rem; font-size: 0.875rem; color: #6b7280;">
                                        {{ $santri->email ?? '-' }}
                                    </td>
                                    <td style="padding: 0.875rem 1.5rem; font-size: 0.875rem; color: #6b7280;">
                                        {{ $santri->no_hp ?? '-' }}
                                    </td>
                                    <td style="padding: 0.875rem 1.5rem; text-align: center;">
                                        @if($santri->jenis_kelamin === 'L')
                                            <span style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; background-color: #dbeafe; color: #1d4ed8; border-radius: 9999px;">
                                                Laki-laki
                                            </span>
                                        @elseif($santri->jenis_kelamin === 'P')
                                            <span style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; background-color: #fce7f3; color: #be185d; border-radius: 9999px;">
                                                Perempuan
                                            </span>
                                        @else
                                            <span style="font-size: 0.875rem; color: #9ca3af;">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding: 3rem 1.5rem; text-align: center;">
                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin-bottom: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <p style="color: #6b7280;">Belum ada santri di kelas ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
