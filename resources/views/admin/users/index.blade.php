<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.5rem;">
                <div>
                    <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Manajemen Akun</h1>
                    <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Kelola semua akun pengguna sistem.</p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                   style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background-color: #16a34a; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Akun
                </a>
            </div>

            @if (session('success'))
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 0.5rem;">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div style="background: linear-gradient(135deg, #dc2626 0%, #f87171 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ \App\Models\User::where('role', 'santri')->count() }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Santri</p>
                        </div>
                        <div style="width: 2.5rem; height: 2.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #16a34a 0%, #4ade80 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ \App\Models\User::where('role', 'guru')->count() }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Guru</p>
                        </div>
                        <div style="width: 2.5rem; height: 2.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ \App\Models\User::where('role', 'civitas')->count() }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Civitas</p>
                        </div>
                        <div style="width: 2.5rem; height: 2.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%); border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="font-size: 1.75rem; font-weight: bold; color: white;">{{ \App\Models\User::count() }}</p>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Total</p>
                        </div>
                        <div style="width: 2.5rem; height: 2.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <!-- Filter Section -->
                <div style="padding: 1.25rem; border-bottom: 1px solid #f3f4f6; background-color: #f9fafb;">
                    <form method="GET" action="{{ route('admin.users.index') }}" style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 1rem;">
                        <div style="flex: 1; min-width: 300px;">
                            <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Cari Pengguna</label>
                            <div style="position: relative;">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Cari nama atau email..."
                                       style="width: 100%; padding: 0.625rem 1rem 0.625rem 2.5rem; border: 1px solid #d1d5db; border-radius: 0.625rem; font-size: 0.875rem; transition: all 0.2s; outline: none;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.ring='2px'; this.style.ringColor='#bfdbfe';"
                                       onblur="this.style.borderColor='#d1d5db';">
                                <div style="position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%); color: #9ca3af;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.125rem; height: 1.125rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Filter Role</label>
                            <select name="role"
                                    style="padding: 0.625rem 2.5rem 0.625rem 1rem; border: 1px solid #d1d5db; border-radius: 0.625rem; font-size: 0.875rem; min-width: 160px; background-color: white; appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%20fill%3D%22none%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;">
                                <option value="">Semua Role</option>
                                <option value="santri" {{ request('role') === 'santri' ? 'selected' : '' }}>Santri</option>
                                <option value="guru" {{ request('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="civitas" {{ request('role') === 'civitas' ? 'selected' : '' }}>Civitas</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div style="display: flex; gap: 0.75rem;">
                            <button type="submit" 
                                    style="padding: 0.625rem 1.5rem; background-color: #111827; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.625rem; border: none; cursor: pointer; transition: background 0.2s;"
                                    onmouseover="this.style.backgroundColor='#1f2937'"
                                    onmouseout="this.style.backgroundColor='#111827'">
                                Cari & Filter
                            </button>
                            <a href="{{ route('admin.users.index') }}" 
                               style="padding: 0.625rem 1.5rem; background-color: white; color: #374151; font-size: 0.875rem; font-weight: 600; border-radius: 0.625rem; text-decoration: none; border: 1px solid #d1d5db; transition: background 0.2s;"
                               onmouseover="this.style.backgroundColor='#f9fafb'"
                               onmouseout="this.style.backgroundColor='white'">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Nama
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Email
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Role
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Dibuat
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr style="border-bottom: 1px solid #f3f4f6; {{ $index % 2 == 1 ? 'background-color: #f9fafb;' : 'background-color: white;' }}">
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            @php
                                                $avatarColors = [
                                                    'admin' => 'linear-gradient(135deg, #7c3aed, #a78bfa)',
                                                    'guru' => 'linear-gradient(135deg, #16a34a, #4ade80)',
                                                    'santri' => 'linear-gradient(135deg, #dc2626, #f87171)',
                                                    'civitas' => 'linear-gradient(135deg, #2563eb, #60a5fa)',
                                                ];
                                                $avatarBg = $avatarColors[$user->role] ?? 'linear-gradient(135deg, #6b7280, #9ca3af)';
                                            @endphp
                                            <div style="width: 2.25rem; height: 2.25rem; border-radius: 50%; background: {{ $avatarBg }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.875rem;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div style="font-size: 0.875rem; font-weight: 500; color: #111827;">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="font-size: 0.875rem; color: #6b7280;">{{ $user->email }}</div>
                                    </td>
                                    <td style="padding: 1rem 1.5rem; text-align: center;">
                                        @php
                                            $roleStyles = [
                                                'admin' => 'background-color: #f3e8ff; color: #7c3aed;',
                                                'guru' => 'background-color: #dcfce7; color: #16a34a;',
                                                'santri' => 'background-color: #fee2e2; color: #dc2626;',
                                                'civitas' => 'background-color: #dbeafe; color: #2563eb;',
                                                'dema' => 'background-color: #fef3c7; color: #d97706;',
                                            ];
                                            $roleStyle = $roleStyles[$user->role] ?? 'background-color: #f3f4f6; color: #6b7280;';
                                        @endphp
                                        <span style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $roleStyle }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem 1.5rem; text-align: center;">
                                        <div style="font-size: 0.875rem; color: #6b7280;">{{ $user->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                                            <!-- View Button -->
                                            <a href="{{ route('admin.users.show', $user) }}" 
                                               style="display: inline-flex; align-items: center; color: #2563eb; font-size: 0.75rem; font-weight: 600; text-decoration: none;"
                                               title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat
                                            </a>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                               style="display: inline-flex; align-items: center; color: #ea580c; font-size: 0.75rem; font-weight: 600; text-decoration: none;"
                                               title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            @if ($user->id !== auth()->id())
                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline; margin: 0;"
                                                      onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            style="display: inline-flex; align-items: center; justify-content: center; width: 1.75rem; height: 1.75rem; color: #dc2626; background: none; border: none; cursor: pointer; border-radius: 0.25rem;"
                                                            title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding: 3rem 1.5rem; text-align: center;">
                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin-bottom: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <p style="color: #6b7280; margin-bottom: 0.5rem;">Belum ada akun.</p>
                                            <a href="{{ route('admin.users.create') }}" style="color: #16a34a; text-decoration: none; font-weight: 500;">
                                                Tambah akun pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($users->hasPages())
                    <div style="padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                        <div style="font-size: 0.875rem; color: #6b7280;">
                            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} akun
                        </div>
                        <div style="display: flex; gap: 0.25rem;">
                            @if ($users->onFirstPage())
                                <span style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #9ca3af; background-color: #f3f4f6; border-radius: 0.375rem;">Previous</span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}" style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #374151; background-color: white; border: 1px solid #d1d5db; border-radius: 0.375rem; text-decoration: none;">Previous</a>
                            @endif
                            
                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #374151; background-color: white; border: 1px solid #d1d5db; border-radius: 0.375rem; text-decoration: none;">Next</a>
                            @else
                                <span style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #9ca3af; background-color: #f3f4f6; border-radius: 0.375rem;">Next</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
