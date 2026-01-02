<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm p-8 text-center">
                <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Akses Terbatas</h1>
                <p class="text-gray-600 mb-8">
                    {{ $message ?? 'Mohon maaf, halaman presensi hanya dapat diakses pada hari pelaksanaan jadwal kegiatan.' }}
                </p>

                <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100 text-left">
                    <h3 class="font-bold text-gray-800 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Jadwal Mingguan
                    </h3>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-600 text-lg font-bold">{{ now()->translatedFormat('l') }}</span>
                        <span class="text-red-600 font-bold bg-red-50 px-3 py-1 rounded-full uppercase tracking-wider">Status: Tidak Terjadwal</span>
                    </div>
                </div>

                @php
                    $role = Auth::user()->role;
                    $backUrl = match($role) {
                        'civitas' => route('civitas.presensi'),
                        'dema' => route('dema.presensi'),
                        'santri' => route('santri.dashboard'),
                        'guru' => route('guru.presensi'),
                        'admin' => route('admin.presensi'),
                        default => url()->previous(),
                    };
                @endphp
                
                <a href="{{ $backUrl }}" class="inline-flex items-center justify-center w-full px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-all duration-200">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
