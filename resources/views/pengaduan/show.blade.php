<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold">{{ $pengaduan->judul }}</h3>
                            <p class="text-sm text-gray-500">Dilaporkan pada: {{ $pengaduan->created_at->format('d M Y H:i') }}</p>
                        </div>
                        @php
                            $colors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'proses' => 'bg-blue-100 text-blue-800',
                                'selesai' => 'bg-green-100 text-green-800',
                                'ditolak' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $colors[$pengaduan->status] }}">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 border-b border-gray-100 pb-6">
                        <div>
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Santri Terlapor</h4>
                            <p class="font-medium text-lg">{{ $pengaduan->santri->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $pengaduan->santri->kelas->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Pelapor</h4>
                            <p class="font-medium text-lg">{{ $pengaduan->reporter->name }}</p>
                            <p class="text-sm text-gray-500">{{ ucfirst($pengaduan->reporter->role) }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Deskripsi Kejadian</h4>
                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 whitespace-pre-wrap leading-relaxed">
{{ $pengaduan->deskripsi }}
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Tanggal Kejadian: {{ $pengaduan->tanggal_kejadian->format('d F Y') }}</p>
                    </div>

                    {{-- Admin Actions --}}
                    @if(Auth::user()->role === 'admin')
                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <h4 class="text-sm font-semibold text-gray-700 mb-4">Update Status (Admin Only)</h4>
                            <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST" class="flex items-center gap-3">
                                @csrf
                                @method('PUT')
                                
                                <select name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                                    <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>

                                <x-primary-button>Update Status</x-primary-button>
                            </form>
                        </div>
                    @endif

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between">
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.pengaduan.index') : route('pengaduan.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                            &larr; Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
