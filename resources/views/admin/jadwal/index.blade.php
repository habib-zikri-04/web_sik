<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.5rem;">
                <div>
                    <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Manajemen Jadwal</h1>
                    <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Kelola dan pantau jadwal kelas dengan mudah.</p>
                </div>
                <a href="{{ route('admin.jadwal.create') }}"
                   style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background-color: #16a34a; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 1px 3px rgba(0,0,0,0.1);"
                   onmouseover="this.style.backgroundColor='#15803d';"
                   onmouseout="this.style.backgroundColor='#16a34a';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Jadwal
                </a>
            </div>

            @if (session('success'))
                <div style="margin-bottom: 1rem; padding: 1rem; background-color: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                <!-- Filter Section -->
                <div style="padding: 1rem; border-bottom: 1px solid #f3f4f6;">
                    <form method="GET" action="{{ route('admin.jadwal.index') }}" style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 1rem;">
                        <div>
                            <label for="tanggal" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Filter Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}"
                                   style="padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; min-width: 160px;">
                        </div>
                        <div>
                            <label for="kelas_id" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Filter Kelas</label>
                            <select name="kelas_id" id="kelas_id"
                                    style="padding: 0.5rem 2rem 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem; min-width: 180px; background-color: white;">
                                <option value="">Semua Kelas</option>
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <button type="submit" 
                                    style="padding: 0.5rem 1rem; background-color: #374151; color: white; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; border: none; cursor: pointer;"
                                    onmouseover="this.style.backgroundColor='#1f2937';"
                                    onmouseout="this.style.backgroundColor='#374151';">
                                Filter
                            </button>
                            <a href="{{ route('admin.jadwal.index') }}" 
                               style="padding: 0.5rem 1rem; background-color: white; color: #374151; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; text-decoration: none; border: 1px solid #d1d5db;">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Jadwal & Hari
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Tanggal Input
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Jam & Ruang
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Subject & Guru
                                </th>
                                <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwals as $index => $jadwal)
                                @php
                                    $isToday = \Carbon\Carbon::parse($jadwal->tanggal)->isToday();
                                @endphp
                                <tr style="border-bottom: 1px solid #f3f4f6; {{ $index % 2 == 1 ? 'background-color: #f9fafb;' : 'background-color: white;' }} {{ $isToday ? 'border-l-4 border-l-green-500' : '' }}">
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="font-size: 0.875rem; font-weight: 700; color: #111827;">
                                            @php
                                                $date = \Carbon\Carbon::parse($jadwal->tanggal);
                                                $days = [0=>'Minggu', 1=>'Senin', 2=>'Selasa', 3=>'Setiap Rabu', 4=>'Kamis', 5=>'Jumat', 6=>'Sabtu'];
                                                $dayDisplay = $days[$date->dayOfWeek];
                                            @endphp
                                            {{ $dayDisplay }}
                                        </div>
                                        @if($isToday)
                                            <span style="display: inline-block; margin-top: 0.25rem; padding: 0.125rem 0.5rem; font-size: 0.625rem; font-weight: bold; background-color: #dcfce7; color: #166534; border-radius: 4px; text-transform: uppercase;">Hari Ini</span>
                                        @endif
                                    </td>
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="font-size: 0.75rem; color: #6b7280;">
                                            {{ $jadwal->created_at->format('d/m/y') }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #9ca3af;">
                                            {{ $jadwal->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="font-size: 0.875rem; color: #111827;">
                                            {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #6b7280;">
                                            {{ $jadwal->ruang ?? '-' }}
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="font-size: 0.875rem; font-weight: 500; color: #0369a1;">
                                            {{ $jadwal->subject->nama ?? '-' }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #6b7280;">
                                            {{ $jadwal->pengajar->nama ?? 'Bersama-sama' }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #9ca3af;">
                                            Kelas: {{ $jadwal->kelas->nama ?? '-' }}
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 1.5rem;">
                                        <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                            <!-- View Button -->
                                            <a href="{{ route('admin.jadwal.show', $jadwal) }}" 
                                               style="display: inline-flex; align-items: center; color: #2563eb; font-size: 0.75rem; font-weight: 600; text-decoration: none;"
                                               title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat
                                            </a>
                                            <!-- QR Button -->
                                            <a href="{{ route('admin.jadwal.show', $jadwal) }}" 
                                               style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; background-color: #16a34a; color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.375rem; text-decoration: none;"
                                               title="Lihat QR Code">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                                </svg>
                                                QR
                                            </a>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.jadwal.edit', $jadwal) }}" 
                                               style="display: inline-flex; align-items: center; color: #ea580c; font-size: 0.75rem; font-weight: 600; text-decoration: none;"
                                               title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 0.875rem; height: 0.875rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST" style="display: inline; margin: 0;"
                                                  onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        style="display: inline-flex; align-items: center; justify-content: center; width: 1.75rem; height: 1.75rem; color: #dc2626; background: none; border: none; cursor: pointer; border-radius: 0.25rem;"
                                                        title="Hapus"
                                                        onmouseover="this.style.backgroundColor='#fef2f2';"
                                                        onmouseout="this.style.backgroundColor='transparent';">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="padding: 3rem 1.5rem; text-align: center;">
                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: #d1d5db; margin-bottom: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p style="color: #6b7280; margin-bottom: 0.5rem;">Belum ada jadwal.</p>
                                            <a href="{{ route('admin.jadwal.create') }}" style="color: #16a34a; text-decoration: none; font-weight: 500;">
                                                Tambah jadwal pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
