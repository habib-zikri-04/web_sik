<x-app-layout>
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Nilai & Feedback</h1>
        <p class="text-sm text-gray-500 mt-1">
            {{ $subject->nama }} • {{ $kelas->nama }}
        </p>
    </div>

    {{-- List Santri --}}
    <div class="space-y-4">
        @foreach ($santris as $santri)
            @php
                $nilai = $santri->nilai->first();
            @endphp

            <form method="POST"
                  action="{{ route('guru.nilai.store') }}"
                  class="bg-white border rounded-xl p-5 hover:shadow-sm transition">
                @csrf

                <input type="hidden" name="santri_id" value="{{ $santri->id }}">
                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

                {{-- Nama Santri --}}
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-800 text-base">
                        {{ $santri->user->name }}
                    </h3>
                </div>

                {{-- Input --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Nilai
                        </label>
                        <input
                            type="number"
                            name="nilai"
                            min="0"
                            max="100"
                            value="{{ $nilai->nilai ?? '' }}"
                            class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-lime-700 focus:border-lime-700"
                        >
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Feedback
                        </label>
                        <textarea
                            name="feedback"
                            rows="2"
                            class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-lime-700 focus:border-lime-700"
                        >{{ $nilai->feedback ?? '' }}</textarea>
                    </div>
                </div>

                {{-- Action --}}
                <div class="mt-4 flex justify-end">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-lime-800 text-white text-sm font-medium rounded-lg hover:bg-lime-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        @endforeach
    </div>

</div>
</x-app-layout>
