<section>
    <header style="margin-bottom: 1.5rem;">
        <p style="font-size: 0.875rem; color: #6b7280;">
            Setelah akun Anda dihapus, semua data akan dihapus permanen. Sebelum menghapus akun, silakan unduh data yang ingin Anda simpan.
        </p>
    </header>

    <button type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            style="padding: 0.625rem 1.25rem; background-color: #dc2626; color: white; font-size: 0.875rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;"
            onmouseover="this.style.backgroundColor='#b91c1c';"
            onmouseout="this.style.backgroundColor='#dc2626';">
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 1.5rem;">
            @csrf
            @method('delete')

            <h2 style="font-size: 1.125rem; font-weight: 600; color: #111827;">
                Yakin ingin menghapus akun?
            </h2>

            <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;">
                Setelah akun dihapus, semua data akan dihapus permanen. Masukkan password Anda untuk mengkonfirmasi penghapusan akun.
            </p>

            <div style="margin-top: 1.5rem;">
                <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                    Password
                </label>
                <input id="password" name="password" type="password" placeholder="Masukkan password Anda"
                       style="width: 75%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; outline: none; transition: all 0.2s;"
                       onfocus="this.style.borderColor='#dc2626'; this.style.boxShadow='0 0 0 3px rgba(220, 38, 38, 0.1)';"
                       onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                @error('password', 'userDeletion')
                    <p style="margin-top: 0.5rem; font-size: 0.75rem; color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" x-on:click="$dispatch('close')"
                        style="padding: 0.625rem 1.25rem; background-color: #f3f4f6; color: #374151; font-size: 0.875rem; font-weight: 500; border: none; border-radius: 0.5rem; cursor: pointer;">
                    Batal
                </button>

                <button type="submit"
                        style="padding: 0.625rem 1.25rem; background-color: #dc2626; color: white; font-size: 0.875rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer;">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
