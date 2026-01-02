<section>
    <header style="margin-bottom: 1.5rem;">
        <p style="font-size: 0.875rem; color: #6b7280;">
            Pastikan akun Anda menggunakan password yang panjang dan acak untuk keamanan.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div style="margin-bottom: 1.25rem;">
            <label for="update_password_current_password" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                Password Saat Ini
            </label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                   style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                   onfocus="this.style.borderColor='#d97706'; this.style.boxShadow='0 0 0 3px rgba(217, 119, 6, 0.1)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
            @error('current_password', 'updatePassword')
                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label for="update_password_password" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                Password Baru
            </label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                   style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                   onfocus="this.style.borderColor='#d97706'; this.style.boxShadow='0 0 0 3px rgba(217, 119, 6, 0.1)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
            @error('password', 'updatePassword')
                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label for="update_password_password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                Konfirmasi Password Baru
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                   onfocus="this.style.borderColor='#d97706'; this.style.boxShadow='0 0 0 3px rgba(217, 119, 6, 0.1)';"
                   onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
            @error('password_confirmation', 'updatePassword')
                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <button type="submit"
                    style="padding: 0.625rem 1.25rem; background-color: #d97706; color: white; font-size: 0.875rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;"
                    onmouseover="this.style.backgroundColor='#b45309';"
                    onmouseout="this.style.backgroundColor='#d97706';">
                Ubah Password
            </button>

            @if (session('status') === 'password-updated')
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
