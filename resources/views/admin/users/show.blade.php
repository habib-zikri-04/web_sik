<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div style="margin-bottom: 1.5rem;">
                <a href="{{ route('admin.users.index') }}" 
                   style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: color 0.2s;"
                   onmouseover="this.style.color='#111827';"
                   onmouseout="this.style.color='#6b7280';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Akun
                </a>
            </div>

            <!-- Header Profile Section -->
            <div style="background: white; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-bottom: 2rem; border: 1px solid #f3f4f6;">
                <div style="height: 120px; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);"></div>
                <div style="padding: 0 2rem 2rem; position: relative;">
                    <div style="display: flex; align-items: flex-end; margin-top: -60px; margin-bottom: 1.5rem;">
                        <div style="position: relative;">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" style="width: 120px; height: 120px; border-radius: 1rem; object-fit: cover; border: 4px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                            @else
                                <div style="width: 120px; height: 120px; border-radius: 1rem; background-color: #f3f4f6; border: 4px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 4rem; height: 4rem; color: #d1d5db;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div style="margin-left: 1.5rem; padding-bottom: 0.5rem;">
                            <h1 style="font-size: 1.75rem; font-weight: 800; color: #111827; margin: 0;">{{ $user->name }}</h1>
                            <p style="color: #6b7280; font-size: 1rem; display: flex; align-items: center; margin-top: 0.25rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $user->email }}
                            </p>
                        </div>
                        <div style="margin-left: auto; padding-bottom: 0.5rem;">
                            <span style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 700; text-transform: uppercase; background-color: {{ 
                                $user->role === 'admin' ? '#fee2e2' : ($user->role === 'guru' ? '#dcfce7' : ($user->role === 'santri' ? '#fef9c3' : '#e0e7ff')) 
                            }}; color: {{ 
                                $user->role === 'admin' ? '#991b1b' : ($user->role === 'guru' ? '#166534' : ($user->role === 'santri' ? '#854d0e' : '#3730a3')) 
                            }};">
                                @php
                                    $roleIcon = match($user->role) {
                                        'admin' => '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 2.944a11.955 11.955 0 01-8.618 3.04m12.796 3.161l-.034-.034a12.02 12.02 0 00-5.525-4.576" /></svg>',
                                        'guru' => '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
                                        'santri' => '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>',
                                        default => '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
                                    };
                                @endphp
                                {!! $roleIcon !!}
                                {{ strtoupper($user->role) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                <!-- Account Information -->
                <div style="grid-column: span 1; background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #f3f4f6;">
                    <h2 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin-bottom: 1.25rem; display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem; color: #3b82f6;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        Informasi Akun
                    </h2>
                    <div style="space-y: 1.25rem;">
                        <div style="margin-bottom: 1.25rem;">
                            <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">ID Pengguna</p>
                            <p style="font-size: 1rem; color: #374151; font-weight: 600;">#{{ $user->id }}</p>
                        </div>
                        <div style="margin-bottom: 1.25rem;">
                            <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Dibuat Pada</p>
                            <p style="font-size: 1rem; color: #374151;">{{ $user->created_at->translatedFormat('d F Y') }}</p>
                            <p style="font-size: 0.75rem; color: #9ca3af;">{{ $user->created_at->diffForHumans() }}</p>
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Update Terakhir</p>
                            <p style="font-size: 1rem; color: #374151;">{{ $user->updated_at->translatedFormat('d F Y') }}</p>
                        </div>
                        <a href="{{ route('admin.users.edit', $user) }}" style="display: block; text-align: center; padding: 0.75rem; background-color: #3b82f6; color: white; border-radius: 0.625rem; font-weight: 600; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#2563eb';" onmouseout="this.style.backgroundColor='#3b82f6';">
                            Edit Profil
                        </a>
                    </div>
                </div>

                <!-- Personal Information / Detailed Detail -->
                <div style="grid-column: span 2; background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #f3f4f6;">
                    <h2 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin-bottom: 1.5rem; display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem; color: #10b981;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Detail Personal
                    </h2>

                    @if($user->role === 'santri' && $user->santri)
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Nama Lengkap</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->santri->nama }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Kelas Aktif</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->santri->kelas->nama ?? 'Belum Ditentukan' }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">No. WhatsApp</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->santri->no_hp ?? '-' }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Alamat</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->santri->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    @elseif($user->role === 'guru' && $user->pengajar)
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Nama Lengkap</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->pengajar->nama }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Mata Pelajaran</p>
                                <span style="display: inline-block; padding: 0.25rem 0.75rem; background-color: #dbeafe; color: #1e40af; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">
                                    {{ $user->pengajar->subject->nama ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">No. WhatsApp</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->pengajar->no_hp ?? '-' }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Alamat</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->pengajar->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    @elseif($user->role === 'civitas' && $user->civitas)
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Nama Lengkap</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->civitas->nama }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">No. WhatsApp</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->civitas->no_hp ?? '-' }}</p>
                            </div>
                            <div style="grid-column: span 2;">
                                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.25rem;">Alamat</p>
                                <p style="font-size: 1.125rem; font-weight: 600; color: #111827;">{{ $user->civitas->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    @else
                        <div style="padding: 2rem; text-align: center; background-color: #f9fafb; border-radius: 0.75rem; border: 1px dashed #d1d5db;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #9ca3af; margin: 0 auto 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p style="color: #6b7280; font-size: 0.875rem;">Tidak ada detail tambahan untuk role ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
