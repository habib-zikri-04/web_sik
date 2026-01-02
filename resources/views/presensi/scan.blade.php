<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Dynamic Back Button -->
            <div class="mb-6">
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
                <a href="{{ $backUrl }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="font-medium">Kembali</span>
                </a>
            </div>

            <h1 class="text-2xl font-bold mb-6 text-center">Scan QR Presensi</h1>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                @if(isset($jadwalId) && $jadwalId)
                    <div class="text-center py-6">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold mb-2">QR Code Dikenali</h2>
                        <p class="text-gray-600 mb-6">Klik tombol di bawah untuk mencatat kehadiran Anda pada sesi ini.</p>
                        
                        <form method="POST" action="{{ route('presensi.store') }}">
                            @csrf
                            <input type="hidden" name="jadwal_id" value="{{ $jadwalId }}">
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform active:scale-95">
                                Konfirmasi Kehadiran
                            </button>
                        </form>
                    </div>
                @else
                    <div id="reader" class="mx-auto" style="width: 100%; max-width: 420px;"></div>
                    <p id="scan-error" class="text-sm text-red-600 mt-3 text-center"></p>

                    <form id="presensi-form" method="POST" action="{{ route('presensi.store') }}" class="mt-6 hidden">
                        @csrf
                        <input type="hidden" name="jadwal_id" id="payload">
                        <button class="w-full bg-red-600 text-white py-2 rounded-lg">
                            Simpan Presensi
                        </button>
                    </form>

                    <p id="scan-result" class="text-sm text-gray-600 mt-4 text-center"></p>
                @endif
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    if (!window.startQrScanner) return;

    window.startQrScanner('reader', function (decodedText) {

        // pastikan isinya angka
        if (!/^\d+$/.test(decodedText)) {
            document.getElementById('scan-error').textContent =
                'QR tidak valid';
            return;
        }

        document.getElementById('scan-result').textContent =
            'QR terbaca, menyimpan presensi...';

        document.getElementById('payload').value = decodedText;

        // auto submit
        document.getElementById('presensi-form').submit();
    });
});
</script>

</x-app-layout>
