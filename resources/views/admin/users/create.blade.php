<x-app-layout>
    <style>
        .password-field-wrapper {
            position: relative;
            display: block;
            width: 100%;
        }
        
        .password-field-wrapper .password-input {
            padding-right: 3rem !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        
        .password-toggle-btn {
            position: absolute;
            top: 50%;
            right: 0.75rem;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            padding: 0.375rem;
            cursor: pointer;
            color: #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
            z-index: 10;
        }
        
        .password-toggle-btn:hover {
            color: #dc2626;
            background-color: rgba(220, 38, 38, 0.08);
        }
        
        .password-toggle-btn:focus {
            outline: none;
            color: #dc2626;
        }
        
        .password-toggle-btn:active {
            transform: translateY(-50%) scale(0.92);
        }
        
        .password-toggle-btn .eye-icon {
            width: 1.125rem;
            height: 1.125rem;
            transition: opacity 0.15s ease, transform 0.15s ease;
        }
        
        .password-toggle-btn .eye-open {
            display: none;
        }
        
        .password-toggle-btn .eye-closed {
            display: block;
        }
        
        .password-toggle-btn:hover .eye-icon {
            transform: scale(1.08);
        }
    </style>
    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Akun
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h1 class="text-2xl font-bold mb-6">Tambah Akun Baru</h1>

                <form action="{{ route('admin.users.store') }}" method="POST" id="userForm">
                    @csrf

                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                            Role Akun <span class="text-red-500">*</span>
                        </label>
                        <select name="role" id="role" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                onchange="toggleRoleFields()">
                            <option value="">-- Pilih Role --</option>
                            <option value="santri" {{ old('role') === 'santri' ? 'selected' : '' }}>Santri</option>
                            <option value="guru" {{ old('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="civitas" {{ old('role') === 'civitas' ? 'selected' : '' }}>Civitas</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                               placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                               placeholder="contoh@email.com" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="password-field-wrapper">
                                <input type="password" name="password" id="password"
                                       class="password-input w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                       placeholder="Minimal 8 karakter" required>
                                <button type="button" onclick="togglePassword('password')" 
                                        class="password-toggle-btn"
                                        tabindex="-1"
                                        title="Tampilkan password"
                                        aria-label="Toggle password visibility">
                                    <svg id="password_eye_open" class="eye-icon eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="password_eye_closed" class="eye-icon eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <div class="password-field-wrapper">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="password-input w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                       placeholder="Ulangi password" required>
                                <button type="button" onclick="togglePassword('password_confirmation')" 
                                        class="password-toggle-btn"
                                        tabindex="-1"
                                        title="Tampilkan password"
                                        aria-label="Toggle password visibility">
                                    <svg id="password_confirmation_eye_open" class="eye-icon eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="password_confirmation_eye_closed" class="eye-icon eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">
                            No. HP
                        </label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                               placeholder="08xxxxxxxxxx">
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">
                            Alamat
                        </label>
                        <textarea name="alamat" id="alamat" rows="2"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                  placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Santri-specific fields -->
                    <div id="santriFields" class="hidden space-y-4">
                        <div class="p-4 bg-red-50 rounded-lg">
                            <h3 class="font-medium text-red-800 mb-3">Data Santri</h3>
                            
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Kelamin
                                </label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Kelas
                                </label>
                                <select name="kelas_id" id="kelas_id"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelasList as $kelas)
                                        <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                            {{ $kelas->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Guru-specific fields -->
                    <div id="guruFields" class="hidden space-y-4">
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h3 class="font-medium text-green-800 mb-3">Data Guru</h3>
                            
                            <div>
                                <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Mata Pelajaran
                                </label>
                                <select name="subject_id" id="subject_id"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                    <option value="">-- Pilih Subject --</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('admin.users.index') }}"
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Simpan Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            const santriFields = document.getElementById('santriFields');
            const guruFields = document.getElementById('guruFields');
            
            santriFields.classList.add('hidden');
            guruFields.classList.add('hidden');
            
            if (role === 'santri') {
                santriFields.classList.remove('hidden');
            } else if (role === 'guru') {
                guruFields.classList.remove('hidden');
            }
        }
        
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(inputId + '_eye_open');
            const eyeClosed = document.getElementById(inputId + '_eye_closed');
            const button = eyeOpen.parentElement;
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
                button.title = 'Sembunyikan password';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
                button.title = 'Tampilkan password';
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', toggleRoleFields);
    </script>
</x-app-layout>
