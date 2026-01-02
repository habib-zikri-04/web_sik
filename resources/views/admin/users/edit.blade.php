<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div style="margin-bottom: 1rem;">
                <a href="{{ route('admin.users.index') }}" 
                   style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; font-size: 0.875rem;"
                   onmouseover="this.style.color='#374151';"
                   onmouseout="this.style.color='#6b7280';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Akun
                </a>
            </div>

            <!-- User Profile Card Header -->
            @php
                $roleColors = [
                    'admin' => ['bg' => 'linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%)', 'badge' => '#7c3aed'],
                    'guru' => ['bg' => 'linear-gradient(135deg, #16a34a 0%, #4ade80 100%)', 'badge' => '#16a34a'],
                    'santri' => ['bg' => 'linear-gradient(135deg, #dc2626 0%, #f87171 100%)', 'badge' => '#dc2626'],
                    'civitas' => ['bg' => 'linear-gradient(135deg, #2563eb 0%, #60a5fa 100%)', 'badge' => '#2563eb'],
                ];
                $colors = $roleColors[$user->role] ?? ['bg' => 'linear-gradient(135deg, #6b7280 0%, #9ca3af 100%)', 'badge' => '#6b7280'];
                $profileData = $user->santri ?? $user->pengajar ?? $user->civitas;
            @endphp

            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 1.5rem;">
                <!-- Header with Avatar -->
                <div style="background: {{ $colors['bg'] }}; padding: 2rem; text-align: center;">
                    <div style="width: 5rem; height: 5rem; border-radius: 50%; background-color: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; border: 3px solid white;">
                        <span style="font-size: 2rem; font-weight: bold; color: white;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <h1 style="font-size: 1.5rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">{{ $user->name }}</h1>
                    <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-bottom: 0.75rem;">{{ $user->email }}</p>
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background-color: rgba(255,255,255,0.2); color: white; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; text-transform: uppercase;">
                        {{ $user->role }}
                    </span>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.users.update', $user) }}" method="POST" style="padding: 1.5rem;">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb;">
                            <div style="width: 2rem; height: 2rem; background-color: #dbeafe; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #2563eb;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Informasi Dasar</h2>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                            <div>
                                <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                    Nama Lengkap <span style="color: #dc2626;">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                       style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                       onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                                       onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                       placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                    Email <span style="color: #dc2626;">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                       style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                       onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                                       onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                       placeholder="contoh@email.com">
                                @error('email')
                                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb;">
                            <div style="width: 2rem; height: 2rem; background-color: #fef3c7; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Ubah Password</h2>
                                <p style="font-size: 0.75rem; color: #6b7280;">Kosongkan jika tidak ingin mengubah password</p>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                            <div>
                                <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                    Password Baru
                                </label>
                                <div style="position: relative;">
                                    <input type="password" name="password" id="password"
                                           style="width: 100%; padding: 0.625rem 2.5rem 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                           onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                                           onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                           placeholder="Minimal 8 karakter">
                                    <button type="button" onclick="togglePassword('password')" 
                                            style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0.25rem;">
                                        <svg id="password_eye" xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                    Konfirmasi Password
                                </label>
                                <div style="position: relative;">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           style="width: 100%; padding: 0.625rem 2.5rem 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                           onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                                           onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                           placeholder="Ulangi password">
                                    <button type="button" onclick="togglePassword('password_confirmation')" 
                                            style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0.25rem;">
                                        <svg id="password_confirmation_eye" xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb;">
                            <div style="width: 2rem; height: 2rem; background-color: #dcfce7; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #16a34a;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Informasi Kontak</h2>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                            <div>
                                <label for="no_hp" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                    No. HP
                                </label>
                                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $profileData?->no_hp) }}"
                                       style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                       onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                                       onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                       placeholder="08xxxxxxxxxx">
                                @error('no_hp')
                                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="alamat" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                    Alamat
                                </label>
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $profileData?->alamat) }}"
                                       style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                                       onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                                       onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                       placeholder="Alamat lengkap">
                                @error('alamat')
                                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Role-Specific Section: Santri -->
                    @if ($user->role === 'santri')
                        <div style="margin-bottom: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb;">
                                <div style="width: 2rem; height: 2rem; background-color: #fee2e2; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #dc2626;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Data Santri</h2>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                                <div>
                                    <label for="jenis_kelamin" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                        Jenis Kelamin
                                    </label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                            style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; background-color: white;">
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin', $user->santri?->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $user->santri?->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="kelas_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                        Kelas
                                    </label>
                                    <select name="kelas_id" id="kelas_id"
                                            style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; background-color: white;">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelasList as $kelas)
                                            <option value="{{ $kelas->id }}" {{ old('kelas_id', $user->santri?->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                                {{ $kelas->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Role-Specific Section: Guru -->
                    @if ($user->role === 'guru')
                        <div style="margin-bottom: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb;">
                                <div style="width: 2rem; height: 2rem; background-color: #dcfce7; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #16a34a;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                    </svg>
                                </div>
                                <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Data Guru</h2>
                            </div>

                            <div>
                                <label for="subject_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem;">
                                    Mata Pelajaran
                                </label>
                                <select name="subject_id" id="subject_id"
                                        style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; background-color: white;">
                                    <option value="">-- Pilih Subject --</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id', $user->pengajar?->subject_id) == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div style="display: flex; justify-content: flex-end; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                        <a href="{{ route('admin.users.index') }}"
                           style="padding: 0.625rem 1.25rem; background-color: #f3f4f6; color: #374151; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; text-decoration: none;"
                           onmouseover="this.style.backgroundColor='#e5e7eb';"
                           onmouseout="this.style.backgroundColor='#f3f4f6';">
                            Batal
                        </a>
                        <button type="submit"
                                style="padding: 0.625rem 1.25rem; background-color: #991b1b; color: white; font-size: 0.875rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer;"
                                onmouseover="this.style.backgroundColor='#7f1d1d';"
                                onmouseout="this.style.backgroundColor='#991b1b';">
                            <span style="display: inline-flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Akun
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(inputId + '_eye');
            
            if (input.type === 'password') {
                input.type = 'text';
                eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                input.type = 'password';
                eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }
    </script>
</x-app-layout>
