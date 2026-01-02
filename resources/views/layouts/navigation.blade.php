<style>
    .nav-container {
        background: linear-gradient(to right, #7f1d1d, #991b1b, #7f1d1d);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .nav-inner {
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1rem;
    }
    .nav-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 4rem;
    }
    .nav-left {
        display: flex;
        align-items: center;
        gap: 2rem;
    }
    .nav-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
    }
    .nav-logo img {
        height: 2.5rem;
        width: auto;
    }
    .nav-links {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.5rem;
        text-decoration: none;
        color: #fecaca;
    }
    .nav-link:hover {
        background-color: rgba(255,255,255,0.1);
        color: white;
    }
    .nav-link.active {
        color: white;
        background-color: rgba(255,255,255,0.15);
    }
    .nav-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .dropdown-container {
        position: relative;
    }
    .dropdown-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: white;
        background-color: rgba(255,255,255,0.1);
        border-radius: 0.5rem;
        border: none;
        cursor: pointer;
    }
    .dropdown-btn:hover {
        background-color: rgba(255,255,255,0.2);
    }
    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        margin-top: 0.5rem;
        width: 12rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        padding: 0.25rem 0;
        z-index: 50;
    }
    .dropdown-menu.show {
        display: block;
    }
    .dropdown-item {
        display: block;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: #374151;
        text-decoration: none;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
    }
    .dropdown-item:hover {
        background-color: #f3f4f6;
    }
    .user-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.875rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .role-badge {
        padding: 0.125rem 0.5rem;
        font-size: 0.6875rem;
        font-weight: 600;
        border-radius: 9999px;
        text-transform: uppercase;
    }
</style>

@php
    $userRole = Auth::user()->role ?? 'guest';
    $userName = Auth::user()->name ?? 'User';
    $userPhoto = Auth::user()->profile_photo ?? null;
    
    // Define avatar colors based on role
    $avatarColors = [
        'admin' => 'linear-gradient(to bottom right, #7c3aed, #a78bfa)',
        'guru' => 'linear-gradient(to bottom right, #16a34a, #4ade80)',
        'santri' => 'linear-gradient(to bottom right, #dc2626, #f87171)',
        'civitas' => 'linear-gradient(to bottom right, #2563eb, #60a5fa)',
    ];
    $avatarBg = $avatarColors[$userRole] ?? 'linear-gradient(to bottom right, #6b7280, #9ca3af)';
    
    // Define role display names
    $roleNames = [
        'admin' => 'Admin',
        'guru' => 'Guru',
        'santri' => 'Santri',
        'civitas' => 'Civitas',
        'dema' => 'DEMA',
    ];
    $roleName = $roleNames[$userRole] ?? 'User';
    
    // Define dashboard route based on role
    $dashboardRoute = match($userRole) {
        'admin' => 'admin.dashboard',
        'guru' => 'guru.dashboard',
        'santri' => 'santri.dashboard',
        'civitas' => 'civitas.dashboard',
        'dema' => 'dema.dashboard',
        default => 'dashboard',
    };
@endphp

<nav class="nav-container">
    <div class="nav-inner">
        <div class="nav-flex">
            <!-- Logo & Navigation Links -->
            <div class="nav-left">
                <!-- Logo -->
                <a href="{{ route($dashboardRoute) }}" class="nav-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>

                <!-- Navigation Links Based on Role -->
                <div class="nav-links">
                    @if($userRole === 'admin')
                        {{-- Admin Navigation --}}
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                            Kelas
                        </a>
                        <a href="{{ route('admin.jadwal.index') }}" class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                            Jadwal
                        </a>
                        <a href="{{ route('admin.presensi') }}" class="nav-link {{ request()->routeIs('admin.presensi*') ? 'active' : '' }}">
                            Presensi
                        </a>
                        <a href="{{ route('admin.rekap-absensi') }}" class="nav-link {{ request()->routeIs('admin.rekap-absensi*') ? 'active' : '' }}">
                            Rekap Absensi
                        </a>
                        <a href="{{ route('admin.rekap-nilai') }}" class="nav-link {{ request()->routeIs('admin.rekap-nilai*') ? 'active' : '' }}">
                            Rekap Nilai
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            Akun
                        </a>
                    @elseif($userRole === 'guru')
                        {{-- Guru Navigation --}}
                        <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('guru.presensi') }}" class="nav-link {{ request()->routeIs('guru.presensi*') ? 'active' : '' }}">
                            Presensi
                        </a>
                        <a href="{{ route('guru.santri') }}" class="nav-link {{ request()->routeIs('guru.santri*') ? 'active' : '' }}">
                            Daftar Santri
                        </a>
                    @elseif($userRole === 'santri')
                        {{-- Santri Navigation --}}
                        <a href="{{ route('santri.dashboard') }}" class="nav-link {{ request()->routeIs('santri.dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('santri.nilai') }}" class="nav-link {{ request()->routeIs('santri.nilai*') ? 'active' : '' }}">
                            Nilai Saya
                        </a>
                    @elseif($userRole === 'civitas')
                        {{-- Civitas Navigation --}}
                        <a href="{{ route('civitas.dashboard') }}" class="nav-link {{ request()->routeIs('civitas.dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('civitas.presensi') }}" class="nav-link {{ request()->routeIs('civitas.presensi') ? 'active' : '' }}">
                            Presensi Mengaji
                        </a>
                    @elseif($userRole === 'dema')
                        {{-- DEMA Navigation --}}
                        <a href="{{ route('dema.dashboard') }}" class="nav-link {{ request()->routeIs('dema.dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('dema.presensi') }}" class="nav-link {{ request()->routeIs('dema.presensi') ? 'active' : '' }}">
                            Presensi Mengaji
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Side - User Dropdown -->
            <div class="nav-right">
                <!-- User Dropdown -->
                <div class="dropdown-container">
                    <button onclick="toggleDropdown()" class="dropdown-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ $roleName }}</span>
                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="dropdown-menu">
                        <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #e5e7eb;">
                            <p style="font-size: 0.875rem; font-weight: 600; color: #111827;">{{ $userName }}</p>
                            <p style="font-size: 0.75rem; color: #6b7280;">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; display: inline; margin-right: 0.5rem; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="color: #dc2626;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem; display: inline; margin-right: 0.5rem; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- User Avatar -->
                <div class="user-avatar" style="background: {{ $avatarBg }};">
                    @if($userPhoto)
                        <img src="{{ asset('storage/' . $userPhoto) }}" alt="Profile">
                    @else
                        {{ strtoupper(substr($userName, 0, 1)) }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = event.target.closest('.dropdown-btn');
        if (!button && dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    });
</script>
