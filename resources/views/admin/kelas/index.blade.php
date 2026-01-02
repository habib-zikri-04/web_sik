<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Kelas</h1>
                    <p class="mt-1 text-sm text-gray-500">Kelola dan pantau kelas-kelas yang ada dengan mudah.</p>
                </div>
                <a href="{{ route('admin.kelas.create') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 text-white text-sm font-semibold rounded-lg hover:opacity-90 transition shadow-sm whitespace-nowrap"
                   style="background-color: #2d5016;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kelas
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <!-- Search Bar -->
                <div style="padding: 1.25rem; border-bottom: 1px solid #f3f4f6; background-color: #f9fafb;">
                    <div style="position: relative; max-width: 300px;">
                        <input type="text" id="searchKelas" 
                               placeholder="Cari kelas..."
                               style="width: 100%; padding: 0.625rem 1rem 0.625rem 2.5rem; border: 1px solid #d1d5db; border-radius: 0.625rem; font-size: 0.875rem; transition: all 0.2s; outline: none;"
                               onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px #bfdbfe';"
                               onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                               onkeyup="filterKelas()">
                        <div style="position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%); color: #9ca3af;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.125rem; height: 1.125rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nama Kelas
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Kode
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Guru Mengajar
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Jumlah Santri
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="kelasTableBody">
                            @forelse ($kelas as $index => $k)
                                @php
                                    $guruMengajar = $k->jadwals->pluck('pengajar')->filter()->unique('id');
                                @endphp
                                <tr class="kelas-row border-b border-gray-100 hover:bg-gray-50 transition-colors {{ $index % 2 == 1 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $k->nama }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-400">{{ $k->kode ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($guruMengajar->count() > 0)
                                            <div class="flex items-center flex-wrap gap-2">
                                                @foreach($guruMengajar->take(3) as $guru)
                                                    @php
                                                        $guruName = $guru->nama ?? $guru->user?->name ?? 'Guru';
                                                        $initial = strtoupper(substr($guruName, 0, 1));
                                                    @endphp
                                                    <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.375rem 0.75rem; background-color: #f3f4f6; border-radius: 9999px; border: 1px solid #e5e7eb;">
                                                        <div style="width: 1.5rem; height: 1.5rem; border-radius: 50%; background: linear-gradient(to bottom right, #22c55e, #15803d); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: bold; flex-shrink: 0;">
                                                            {{ $initial }}
                                                        </div>
                                                        <span style="font-size: 0.75rem; font-weight: 500; color: #374151;">{{ $guruName }}</span>
                                                    </div>
                                                @endforeach
                                                @if($guruMengajar->count() > 3)
                                                    <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-gray-200 text-gray-600 border border-gray-300">
                                                        +{{ $guruMengajar->count() - 3 }} lainnya
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-400 italic">Belum ada jadwal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $k->santris->count() }} santri
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('admin.kelas.show', $k) }}" 
                                               class="inline-flex items-center px-3 py-1.5 text-white text-xs font-semibold rounded-lg hover:opacity-90 transition shadow-sm"
                                               style="background-color: #4a5d23;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('admin.kelas.edit', $k) }}" 
                                               class="inline-flex items-center text-orange-500 hover:text-orange-600 text-xs font-semibold transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.kelas.destroy', $k) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center justify-center w-8 h-8 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                        title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            <p class="text-gray-500 mb-2">Belum ada kelas.</p>
                                            <a href="{{ route('admin.kelas.create') }}" class="text-green-600 hover:underline font-medium">
                                                Tambah kelas pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterKelas() {
            const searchValue = document.getElementById('searchKelas').value.toLowerCase();
            const rows = document.querySelectorAll('.kelas-row');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
