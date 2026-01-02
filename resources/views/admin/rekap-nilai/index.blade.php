<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.5rem;">
                <div>
                    <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Rekap Nilai & Feedback</h1>
                    <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Lihat dan kelola nilai serta feedback untuk semua santri.</p>
                </div>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ route('admin.rekap-nilai.pdf', ['stream' => 1]) }}" target="_blank"
                       style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background-color: #2563eb; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);"
                       onmouseover="this.style.backgroundColor='#1d4ed8';"
                       onmouseout="this.style.backgroundColor='#2563eb';">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat PDF
                    </a>
                    <a href="{{ route('admin.rekap-nilai.pdf') }}"
                       style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background-color: #991b1b; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);"
                       onmouseover="this.style.backgroundColor='#7f1d1d';"
                       onmouseout="this.style.backgroundColor='#991b1b';">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Download PDF
                    </a>
                </div>
            </div>

            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <!-- Filter Section -->
                <div style="padding: 1rem; border-bottom: 1px solid #f3f4f6;">
                    <form method="GET" action="{{ route('admin.rekap-nilai') }}" style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 1rem;">
                        <!-- Search -->
                        <div>
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Cari Nama</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama santri..."
                                   style="padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; min-width: 180px;">
                        </div>
                        <!-- Filter Kelas -->
                        <div>
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Filter Kelas</label>
                            <select name="kelas_id"
                                    style="padding: 0.5rem 2rem 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; min-width: 150px; background-color: white;">
                                <option value="">Semua Kelas</option>
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Filter Subject -->
                        <div>
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Filter Subject</label>
                            <select name="subject_id"
                                    style="padding: 0.5rem 2rem 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; min-width: 150px; background-color: white;">
                                <option value="">Semua Subject</option>
                                @foreach ($subjectList as $subject)
                                    <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <button type="submit" 
                                    style="padding: 0.5rem 1rem; background-color: #374151; color: white; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;">
                                Filter
                            </button>
                            <a href="{{ route('admin.rekap-nilai') }}" 
                               style="padding: 0.5rem 1rem; background-color: white; color: #374151; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; text-decoration: none; border: 1px solid #d1d5db;">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div style="overflow-x: auto; max-height: 500px; overflow-y: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="position: sticky; top: 0; background-color: #f9fafb; z-index: 10;">
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <th style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">No</th>
                                <th style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Nama Santri</th>
                                <th style="padding: 0.75rem 1rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Kelas</th>
                                <th style="padding: 0.75rem 1rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Subject</th>
                                <th style="padding: 0.75rem 1rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Nilai</th>
                                <th style="padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($nilais as $index => $n)
                                <tr style="border-bottom: 1px solid #f3f4f6; {{ $index % 2 == 1 ? 'background-color: #f9fafb;' : 'background-color: white;' }}">
                                    <td style="padding: 0.75rem 1rem; font-size: 0.875rem; color: #6b7280;">
                                        {{ $nilais->firstItem() + $index }}
                                    </td>
                                    <td style="padding: 0.75rem 1rem; font-size: 0.875rem; font-weight: 500; color: #111827;">
                                        {{ $n->santri->user->name ?? '-' }}
                                    </td>
                                    <td style="padding: 0.75rem 1rem; text-align: center;">
                                        <span style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; background-color: #dbeafe; color: #1d4ed8; border-radius: 9999px;">
                                            {{ $n->kelas->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td style="padding: 0.75rem 1rem; text-align: center;">
                                        <span style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; background-color: #fef3c7; color: #92400e; border-radius: 9999px;">
                                            {{ $n->subject->nama ?? '-' }}
                                        </span>
                                    </td>
                                    <td style="padding: 0.75rem 1rem; text-align: center;">
                                        @php
                                            $nilai = $n->nilai ?? 0;
                                            $bgColor = $nilai >= 80 ? '#dcfce7' : ($nilai >= 60 ? '#fef9c3' : '#fee2e2');
                                            $textColor = $nilai >= 80 ? '#166534' : ($nilai >= 60 ? '#854d0e' : '#991b1b');
                                        @endphp
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 700; background-color: {{ $bgColor }}; color: {{ $textColor }}; border-radius: 0.5rem; min-width: 3rem;">
                                            {{ $n->nilai ?? '-' }}
                                        </span>
                                    </td>
                                    <td style="padding: 0.75rem 1rem; font-size: 0.875rem; color: #6b7280; max-width: 250px;">
                                        {{ Str::limit($n->feedback ?? '-', 50) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 3rem 1rem; text-align: center;">
                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin-bottom: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p style="color: #6b7280;">Belum ada data nilai</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($nilais->hasPages())
                    <div style="padding: 1rem; border-top: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                        <div style="font-size: 0.875rem; color: #6b7280;">
                            Menampilkan {{ $nilais->firstItem() }} - {{ $nilais->lastItem() }} dari {{ $nilais->total() }} data
                        </div>
                        <div style="display: flex; gap: 0.25rem;">
                            @if ($nilais->onFirstPage())
                                <span style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #9ca3af; background-color: #f3f4f6; border-radius: 0.375rem;">Previous</span>
                            @else
                                <a href="{{ $nilais->previousPageUrl() }}" style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #374151; background-color: white; border: 1px solid #d1d5db; border-radius: 0.375rem; text-decoration: none;">Previous</a>
                            @endif
                            
                            @if ($nilais->hasMorePages())
                                <a href="{{ $nilais->nextPageUrl() }}" style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #374151; background-color: white; border: 1px solid #d1d5db; border-radius: 0.375rem; text-decoration: none;">Next</a>
                            @else
                                <span style="padding: 0.5rem 0.75rem; font-size: 0.875rem; color: #9ca3af; background-color: #f3f4f6; border-radius: 0.375rem;">Next</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
