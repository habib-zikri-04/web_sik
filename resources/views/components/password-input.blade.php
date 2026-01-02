@props(['disabled' => false, 'id' => null])

@php
    $inputId = $id ?? uniqid('password_');
@endphp

<style>
    .password-wrapper {
        position: relative;
        display: block;
        width: 100%;
    }
    
    .password-wrapper input {
        padding-right: 3rem !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    
    .password-wrapper input:focus {
        outline: none;
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
        color: #4b5563;
        background-color: rgba(107, 114, 128, 0.1);
    }
    
    .password-toggle-btn:focus {
        outline: none;
        color: #4b5563;
        background-color: rgba(107, 114, 128, 0.15);
    }
    
    .password-toggle-btn:active {
        transform: translateY(-50%) scale(0.95);
    }
    
    .password-toggle-btn svg {
        width: 1.125rem;
        height: 1.125rem;
        transition: opacity 0.15s ease, transform 0.15s ease;
    }
    
    .password-toggle-btn:hover svg {
        transform: scale(1.05);
    }

    /* Focus ring for accessibility */
    .password-wrapper input:focus + .password-toggle-btn {
        color: #6366f1;
    }
</style>

<div class="password-wrapper">
    <input 
        type="password" 
        id="{{ $inputId }}"
        @disabled($disabled) 
        {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full']) }}
    >
    <button 
        type="button" 
        onclick="togglePasswordVisibility('{{ $inputId }}')"
        class="password-toggle-btn"
        tabindex="-1"
        title="Toggle password visibility"
        aria-label="Toggle password visibility"
    >
        <!-- Eye icon (password visible) -->
        <svg id="{{ $inputId }}_eye_open" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
        <!-- Eye slash icon (password hidden) -->
        <svg id="{{ $inputId }}_eye_closed" style="display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
        </svg>
    </button>
</div>

@once
@push('scripts')
<script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const eyeOpen = document.getElementById(inputId + '_eye_open');
        const eyeClosed = document.getElementById(inputId + '_eye_closed');
        const button = eyeOpen.parentElement;
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.style.display = 'block';
            eyeClosed.style.display = 'none';
            button.setAttribute('aria-pressed', 'true');
            button.title = 'Hide password';
        } else {
            input.type = 'password';
            eyeOpen.style.display = 'none';
            eyeClosed.style.display = 'block';
            button.setAttribute('aria-pressed', 'false');
            button.title = 'Show password';
        }
    }
</script>
@endpush
@endonce
