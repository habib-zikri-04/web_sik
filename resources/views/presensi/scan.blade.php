<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6 text-center">Scan QR Presensi</h1>

            <div class="bg-white rounded-2xl shadow-sm p-6">
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
