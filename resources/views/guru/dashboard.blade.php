<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold mb-4">Dashboard Guru</h1>

            <p>Halo, {{ auth()->user()->name }}. Anda masuk sebagai <strong>Guru</strong>.</p>
        </div>
    </div>
</x-app-layout>
