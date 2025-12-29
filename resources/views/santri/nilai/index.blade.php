<x-app-layout>
<div class="max-w-7xl mx-auto px-4 py-6">

<h1 class="text-xl font-bold mb-4">Nilai & Feedback</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
@foreach ($data as $d)
    <div class="bg-white rounded-xl border p-4 shadow-sm">

        <h3 class="font-semibold text-gray-800 mb-1">
            {{ $d['subject']->nama }}
        </h3>

        {{-- SUBJECT MENGAJI --}}
        @if ($d['type'] === 'mengaji')
            <p class="text-sm text-gray-600">
                Kehadiran: {{ $d['hadir'] }} / {{ $d['total'] }}
            </p>
            <p class="text-sm mt-1">
                Persentase: <strong>{{ $d['persen'] }}%</strong>
            </p>
        @else
        {{-- SUBJECT NILAI --}}
            <p class="text-sm text-gray-600">
                Nilai: <strong>{{ $d['nilai'] }}</strong>
            </p>
            <p class="text-sm text-gray-500 mt-1">
                {{ $d['feedback'] ?? '-' }}
            </p>
        @endif

        <div class="mt-3">
            @if ($d['lulus'])
                <a href="{{ route('santri.sertifikat', $d['subject']->id) }}"
                   class="inline-block px-3 py-1 bg-emerald-600 text-white text-sm rounded">
                    Download Sertifikat
                </a>
            @else
                <span class="text-sm text-red-600">
                    Belum memenuhi syarat
                </span>
            @endif
        </div>

    </div>
@endforeach
</div>

</div>
</x-app-layout>
