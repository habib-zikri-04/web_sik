<x-guest-layout>
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-size: 1rem; font-weight: 600; color: #374151;">Silahkan login untuk masuk ke akun anda</h2>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email/Username -->
        <div style="margin-bottom: 25px;">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Username"
                   style="width: 100%; border: none; border-bottom: 1.5px solid #d1d5db; padding: 10px 0; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"
                   onfocus="this.style.borderBottomColor='#3b82f6'"
                   onblur="this.style.borderBottomColor='#d1d5db'">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 25px; position: relative;">
            <input id="password" type="password" name="password" required placeholder="Password"
                   style="width: 100%; border: none; border-bottom: 1.5px solid #d1d5db; padding: 10px 30px 10px 0; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"
                   onfocus="this.style.borderBottomColor='#3b82f6'"
                   onblur="this.style.borderBottomColor='#d1d5db'">
            <button type="button" onclick="togglePassword()" 
                    style="position: absolute; right: 0; top: 10px; background: none; border: none; cursor: pointer; color: #9ca3af; padding: 0;">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 35px;">
            <label for="remember_me" style="display: flex; align-items: center; cursor: pointer; color: #6b7280; font-size: 0.85rem;">
                <input id="remember_me" type="checkbox" name="remember" style="margin-right: 8px; border: 1px solid #d1d5db; border-radius: 2px;">
                Remember me..
            </label>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 0.85rem; color: #3b82f6; text-decoration: none;">
                    Forgot password ?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div style="margin-bottom: 20px;">
            <button type="submit"
                    style="width: 100%; background: #3b82f6; color: white; padding: 12px; border: none; border-radius: 4px; font-weight: 600; font-size: 0.75rem; letter-spacing: 0.5px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.5); transition: background 0.2s;"
                    onmouseover="this.style.background='#2563eb'"
                    onmouseout="this.style.background='#3b82f6'">
                SIGN IN
            </button>
        </div>

        <div style="text-align: center;">
            <a href="/" style="font-size: 0.85rem; color: #6b7280; text-decoration: none; display: inline-flex; align-items: center; transition: color 0.2s;"
               onmouseover="this.style.color='#374151'"
               onmouseout="this.style.color='#6b7280'">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; margin-right: 5px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </form>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</x-guest-layout>
