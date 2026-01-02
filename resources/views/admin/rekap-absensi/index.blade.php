<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div style="margin-bottom: 2rem;">
                <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Rekap Absensi</h1>
                <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Unduh laporan rekapitulasi kehadiran dalam format PDF.</p>
            </div>

            <!-- Cards Container -->
            <div style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem;">
                
                <!-- Card Santri -->
                <div style="background: linear-gradient(135deg, #166534 0%, #22c55e 100%); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; color: white;">Rekap Santri</h3>
                                <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Laporan kehadiran per mata pelajaran</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.rekap-absensi.pdf', ['role' => 'santri', 'stream' => 1]) }}" target="_blank"
                               style="display: inline-flex; align-items: center; padding: 0.75rem 1rem; background-color: #15803d; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                               onmouseover="this.style.transform='scale(1.05)';"
                               onmouseout="this.style.transform='scale(1)';">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.rekap-absensi.pdf', 'santri') }}"
                               style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background-color: white; color: #166534; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                               onmouseover="this.style.transform='scale(1.05)';"
                               onmouseout="this.style.transform='scale(1)';">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Guru -->
                <div style="background: linear-gradient(135deg, #991b1b 0%, #dc2626 100%); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; color: white;">Rekap Guru</h3>
                                <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Laporan kehadiran per kelas yang diajar</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.rekap-absensi.pdf', ['role' => 'guru', 'stream' => 1]) }}" target="_blank"
                               style="display: inline-flex; align-items: center; padding: 0.75rem 1rem; background-color: #b91c1c; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                               onmouseover="this.style.transform='scale(1.05)';"
                               onmouseout="this.style.transform='scale(1)';">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.rekap-absensi.pdf', 'guru') }}"
                               style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background-color: white; color: #991b1b; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                               onmouseover="this.style.transform='scale(1.05)';"
                               onmouseout="this.style.transform='scale(1)';">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Civitas -->
                <div style="background: linear-gradient(135deg, #374151 0%, #6b7280 100%); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 3.5rem; height: 3.5rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: 600; color: white;">Rekap Civitas</h3>
                                <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Laporan kehadiran civitas akademika</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.rekap-absensi.pdf', ['role' => 'civitas', 'stream' => 1]) }}" target="_blank"
                               style="display: inline-flex; align-items: center; padding: 0.75rem 1rem; background-color: #1f2937; color: white; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                               onmouseover="this.style.transform='scale(1.05)';"
                               onmouseout="this.style.transform='scale(1)';">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.rekap-absensi.pdf', 'civitas') }}"
                               style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background-color: white; color: #374151; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                               onmouseover="this.style.transform='scale(1.05)';"
                               onmouseout="this.style.transform='scale(1)';">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh PDF
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Info Box -->
            <div style="margin-top: 2rem; padding: 1rem 1.5rem; background-color: #fef3c7; border: 1px solid #fcd34d; border-radius: 0.75rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #d97706; flex-shrink: 0; margin-top: 0.125rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p style="font-size: 0.875rem; font-weight: 500; color: #92400e;">Informasi</p>
                    <p style="font-size: 0.875rem; color: #a16207;">Data rekap diambil dari seluruh catatan absensi yang tersimpan di sistem. Laporan mencakup persentase kehadiran dan status kelayakan ujian (untuk santri).</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
