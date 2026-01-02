<x-app-layout>
    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.kelas.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Kelas
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h1 class="text-2xl font-bold mb-6">Edit Kelas</h1>

                <form action="{{ route('admin.kelas.update', $kela) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Kelas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $kela->nama) }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                               placeholder="Contoh: Menjadi Imam" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kode" class="block text-sm font-medium text-gray-700 mb-1">
                            Kode Kelas (Opsional)
                        </label>
                        <input type="text" name="kode" id="kode" value="{{ old('kode', $kela->kode) }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                               placeholder="Contoh: KLS-001">
                        @error('kode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <strong>💡 Catatan:</strong> Guru yang mengajar di kelas ini ditentukan melalui menu <strong>Jadwal</strong>.
                        </p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.kelas.index') }}"
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Update Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
