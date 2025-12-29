<x-app-layout>
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Rekap Absensi</h1>

        <div class="space-y-3">
            <a href="{{ route('admin.rekap-absensi.pdf', 'santri') }}"
               class="block px-4 py-2 bg-green-600 text-white rounded text-center">
                Unduh PDF Rekap Santri
            </a>

            <a href="{{ route('admin.rekap-absensi.pdf', 'guru') }}"
               class="block px-4 py-2 bg-red-800 text-white rounded text-center">
                Unduh PDF Rekap Guru
            </a>

            <a href="{{ route('admin.rekap-absensi.pdf', 'civitas') }}"
               class="block px-4 py-2 bg-gray-600 text-white rounded text-center">
                Unduh PDF Rekap Civitas
            </a>
        </div>
    </div>
</x-app-layout>
