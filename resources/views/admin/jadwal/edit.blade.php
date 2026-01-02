<x-app-layout>
    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.jadwal.index') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Jadwal
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h1 class="text-2xl font-bold mb-6">Edit Jadwal</h1>

                <form action="{{ route('admin.jadwal.update', $jadwal) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Kelas <span class="text-red-500">*</span>
                            </label>
                            <select name="kelas_id" id="kelas_id" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('kelas_id', $jadwal->kelas_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pengajar_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Guru Pengajar <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>
                            <select name="pengajar_id" id="pengajar_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="">-- Sesi Bersama (Tanpa Pengajar) --</option>
                                @foreach ($pengajars as $pengajar)
                                    <option value="{{ $pengajar->id }}" {{ old('pengajar_id', $jadwal->pengajar_id) == $pengajar->id ? 'selected' : '' }}>
                                        {{ $pengajar->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pengajar_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Mata Pelajaran <span class="text-red-500">*</span>
                            </label>
                            <select name="subject_id" id="subject_id" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="">-- Pilih Subject --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id', $jadwal->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ruang" class="block text-sm font-medium text-gray-700 mb-1">
                                Ruang / No. Kelas
                            </label>
                            <input type="text" name="ruang" id="ruang" value="{{ old('ruang', $jadwal->ruang) }}"
                                   list="ruang_list"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                   placeholder="Contoh: C.1.07.I">
                            <datalist id="ruang_list">
                                <option value="Aula Tuanku Imam Bonjol">
                                <option value="C.1.07.I">
                                <option value="C.1.07.II">
                                <option value="C.1.07.III">
                                <option value="Masjid">
                            </datalist>
                            @error('ruang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                               required>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-1">
                                Jam Mulai <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', substr($jadwal->jam_mulai, 0, 5)) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                   required>
                            @error('jam_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-1">
                                Jam Selesai <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', substr($jadwal->jam_selesai, 0, 5)) }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                   required>
                            @error('jam_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.jadwal.show', $jadwal) }}"
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Update Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subjectSelect = document.getElementById('subject_id');
        const kelasSelect = document.getElementById('kelas_id');
        const ruangInput = document.getElementById('ruang');

        if (subjectSelect) {
            subjectSelect.addEventListener('change', function() {
                const selectedText = this.options[this.selectedIndex].text.toLowerCase();
                
                if (selectedText.includes('mengaji')) {
                    // Coba cari kelas "Semua"
                    for (let i = 0; i < kelasSelect.options.length; i++) {
                        if (kelasSelect.options[i].text.toLowerCase().includes('semua')) {
                            kelasSelect.selectedIndex = i;
                            break;
                        }
                    }

                    // Set pengajar ke Bersama (value kosong)
                    const pengajarSelect = document.getElementById('pengajar_id');
                    if (pengajarSelect) pengajarSelect.value = "";
                    
                    // Set ruang default ke Aula jika masih kosong
                    if (ruangInput && !ruangInput.value) {
                        ruangInput.value = 'Aula Tuanku Imam Bonjol';
                    }
                }
            });
        }
    });
</script>
