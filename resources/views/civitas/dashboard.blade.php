<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold mb-4">Dashboard Civitas</h1>

            <p>Halo, {{ auth()->user()->name }}. Anda masuk sebagai <strong>Civitas</strong>.</p>
        </div>
    </div>
</x-app-layout>
