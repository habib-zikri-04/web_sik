<x-app-layout>
    <div class="py-16">
        <div class="max-w-md mx-auto text-center bg-white p-8 rounded-2xl shadow">
            <h1 class="text-2xl font-bold text-green-600 mb-4">
                Presensi Sudah Tercatat
            </h1>

            <p class="text-gray-600 mb-6">
                Anda sudah melakukan presensi untuk sesi ini.
                Terima kasih 🙏
            </p>

            <a href="{{ route('santri.dashboard') }}"
               class="inline-block bg-gray-700 text-white px-6 py-2 rounded-lg">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
