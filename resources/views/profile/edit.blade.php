<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div style="margin-bottom: 1rem;">
                <a href="{{ url()->previous() }}" 
                   style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; font-size: 0.875rem;"
                   onmouseover="this.style.color='#374151';"
                   onmouseout="this.style.color='#6b7280';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Header -->
            <div style="margin-bottom: 2rem;">
                <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Profil Saya</h1>
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Kelola informasi profil dan keamanan akun Anda.</p>
            </div>

            @if (session('status') === 'photo-updated')
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.5rem;">
                    Foto profil berhasil diperbarui!
                </div>
            @endif

            @if (session('status') === 'photo-deleted')
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #fef3c7; border: 1px solid #fcd34d; color: #92400e; border-radius: 0.5rem;">
                    Foto profil berhasil dihapus.
                </div>
            @endif

            <!-- Profile Card with Photo -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 1.5rem;">
                <div style="background: linear-gradient(135deg, #991b1b 0%, #dc2626 100%); padding: 2rem; text-align: center;">
                    <!-- Profile Photo Section -->
                    <div style="position: relative; display: inline-block;">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                 alt="Profile Photo"
                                 style="width: 8rem; height: 8rem; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.2);">
                        @else
                            <div style="width: 8rem; height: 8rem; border-radius: 50%; background: linear-gradient(135deg, #374151, #6b7280); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem; font-weight: bold; border: 4px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.2);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        
                        <!-- Camera Button -->
                        <label for="photo-upload" 
                               style="position: absolute; bottom: 0; right: 0; width: 2.5rem; height: 2.5rem; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #374151;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                    </div>
                    
                    <h2 style="margin-top: 1rem; font-size: 1.5rem; font-weight: bold; color: white;">{{ $user->name }}</h2>
                    <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">{{ $user->email }}</p>
                    <span style="display: inline-block; margin-top: 0.5rem; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; background-color: rgba(255,255,255,0.2); color: white; border-radius: 9999px;">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <!-- Photo Upload Form (Hidden) -->
                <form id="photo-form" action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" id="photo-upload" name="profile_photo" accept="image/*" onchange="document.getElementById('photo-form').submit();">
                </form>

                <!-- Photo Actions -->
                <div style="padding: 1rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: center; gap: 1rem;">
                    <label for="photo-upload" 
                           style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #f3f4f6; color: #374151; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; cursor: pointer;"
                           onmouseover="this.style.backgroundColor='#e5e7eb';"
                           onmouseout="this.style.backgroundColor='#f3f4f6';">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Upload Foto
                    </label>
                    @if($user->profile_photo)
                        <form action="{{ route('profile.photo.delete') }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus foto profil?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #fee2e2; color: #dc2626; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus Foto
                            </button>
                        </form>
                    @endif
                </div>
                @error('profile_photo')
                    <div style="padding: 0.75rem 1rem; background-color: #fee2e2; color: #dc2626; font-size: 0.875rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Profile Information Form -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 2rem; height: 2rem; background-color: #dbeafe; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #2563eb;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Informasi Profil</h2>
                </div>
                <div style="padding: 1.5rem;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Form -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 2rem; height: 2rem; background-color: #fef3c7; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Ubah Password</h2>
                </div>
                <div style="padding: 1.5rem;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Form -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 2rem; height: 2rem; background-color: #fee2e2; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; color: #dc2626;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1rem; font-weight: 600; color: #dc2626;">Hapus Akun</h2>
                </div>
                <div style="padding: 1.5rem;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
