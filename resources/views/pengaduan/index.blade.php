<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Buat Laporan (Hanya Guru/Civitas) --}}
            @if(Auth::user()->role === 'guru' || Auth::user()->role === 'civitas')
            <div class="mb-6 flex justify-end">
                <a href="{{ route('pengaduan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + Buat Laporan Baru
                </a>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($pengaduans->isEmpty())
                        <p class="text-center text-gray-500 py-8">Belum ada data pengaduan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Santri Terlapor</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pengaduans as $p)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $p->tanggal_kejadian->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $p->judul }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $p->santri->nama ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $p->reporter->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $colors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'proses' => 'bg-blue-100 text-blue-800',
                                                    'selesai' => 'bg-green-100 text-green-800',
                                                    'ditolak' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$p->status] }}">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                            @else
                                                <a href="{{ route('pengaduan.show', $p->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
