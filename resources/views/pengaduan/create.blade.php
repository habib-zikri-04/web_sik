<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('pengaduan.store') }}" class="space-y-6">
                        @csrf

                        <!-- Santri -->
                        <div>
                            <x-input-label for="santri_id" :value="__('Nama Santri')" />
                            <select id="santri_id" name="santri_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Santri --</option>
                                @foreach($santris as $santri)
                                    <option value="{{ $santri->id }}">{{ $santri->nama }} ({{ $santri->kelas->nama ?? 'No Kelas' }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('santri_id')" class="mt-2" />
                        </div>

                        <!-- Tanggal Kejadian -->
                        <div>
                            <x-input-label for="tanggal_kejadian" :value="__('Tanggal Kejadian')" />
                            <x-text-input id="tanggal_kejadian" class="block mt-1 w-full" type="date" name="tanggal_kejadian" :value="old('tanggal_kejadian')" required />
                            <x-input-error :messages="$errors->get('tanggal_kejadian')" class="mt-2" />
                        </div>

                        <!-- Judul -->
                        <div>
                            <x-input-label for="judul" :value="__('Judul Masalah')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" placeholder="Contoh: Terlambat masuk kelas berulang kali" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi Detail')" />
                            <textarea id="deskripsi" name="deskripsi" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Kirim Laporan') }}</x-primary-button>
                            <a href="{{ route('pengaduan.index') }}" class="text-gray-600 hover:text-gray-900 underline text-sm">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
