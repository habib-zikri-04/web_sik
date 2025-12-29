<x-app-layout>
<div class="max-w-7xl mx-auto px-4 py-6">

<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold">Rekap Nilai & Feedback</h1>

    <a href="{{ route('admin.rekap-nilai.pdf') }}"
       class="px-4 py-2 bg-red-800 text-white rounded">
        Download PDF
    </a>
</div>

<div class="overflow-x-auto bg-white border rounded-lg">
<table class="w-full text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-3 py-2 text-left">Nama</th>
            <th class="px-3 py-2">Kelas</th>
            <th class="px-3 py-2">Subject</th>
            <th class="px-3 py-2">Nilai</th>
            <th class="px-3 py-2">Feedback</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($nilais as $n)
        <tr class="border-t">
            <td class="px-3 py-2">
                {{ $n->santri->user->name }}
            </td>
            <td class="px-3 py-2 text-center">
                {{ $n->kelas->nama }}
            </td>
            <td class="px-3 py-2 text-center">
                {{ $n->subject->nama }}
            </td>
            <td class="px-3 py-2 text-center font-semibold">
                {{ $n->nilai ?? '-' }}
            </td>
            <td class="px-3 py-2">
                {{ $n->feedback ?? '-' }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-4 text-gray-500">
                Belum ada data nilai
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

</div>
</x-app-layout>
