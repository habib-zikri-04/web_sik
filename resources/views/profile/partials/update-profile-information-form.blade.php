<section>
    <header style="margin-bottom: 1.5rem;">
        <p style="font-size: 0.875rem; color: #6b7280;">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div style="margin-bottom: 1.25rem;">
            <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                Nama Lengkap
            </label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                   onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
            @error('name')
                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                Alamat Email
            </label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                   onfocus="this.style.borderColor='#991b1b'; this.style.boxShadow='0 0 0 3px rgba(153, 27, 27, 0.1)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
            @error('email')
                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: 0.75rem;">
                    <p style="font-size: 0.875rem; color: #6b7280;">
                        Email Anda belum terverifikasi.
                        <button form="send-verification" style="color: #991b1b; text-decoration: underline; background: none; border: none; cursor: pointer;">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #16a34a;">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <button type="submit"
                    style="padding: 0.625rem 1.25rem; background-color: #991b1b; color: white; font-size: 0.875rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;"
                    onmouseover="this.style.backgroundColor='#7f1d1d';"
                    onmouseout="this.style.backgroundColor='#991b1b';">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   style="font-size: 0.875rem; color: #16a34a;">
                    Tersimpan!
                </p>
            @endif
        </div>
    </form>
</section>
