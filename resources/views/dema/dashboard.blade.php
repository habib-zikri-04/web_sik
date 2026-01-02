<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="font-size: 1.5rem; font-weight: bold; color: #111827;">Assalamu'alaikum, {{ Auth::user()->name }}!</h1>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Dashboard DEMA - Selamat datang di Sekolah Islam Kebangsaan</p>
                    </div>
                    <div style="text-align: right;">
                        <p style="font-size: 0.875rem; color: #6b7280;">{{ now()->translatedFormat('l, d F Y') }}</p>
                        <p style="font-size: 0.75rem; color: #9ca3af;">{{ now()->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- Quick Access Cards -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                <!-- Scan QR Card -->
                <a href="{{ route('presensi.scan') }}" style="text-decoration: none;">
                    <div style="background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); border-radius: 1rem; padding: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s, box-shadow 0.2s;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 4rem; height: 4rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Scan QR Absen</h3>
                                <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Mulai scan QR kehadiran sekarang</p>
                            </div>
                        </div>
                        <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: flex-end;">
                            <span style="display: inline-flex; align-items: center; font-size: 0.875rem; color: white;">
                                Buka Scanner
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-left: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Presensi Mengaji Card -->
                <a href="{{ route('dema.presensi') }}" style="text-decoration: none;">
                    <div style="background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%); border-radius: 1rem; padding: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s, box-shadow 0.2s;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 4rem; height: 4rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Riwayat Presensi</h3>
                                <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Lihat jadwal dan rekap kehadiran mengaji</p>
                            </div>
                        </div>
                        <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: flex-end;">
                            <span style="display: inline-flex; align-items: center; font-size: 0.875rem; color: white;">
                                Lihat Rekap
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-left: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Profile Card -->
                <a href="{{ route('profile.edit') }}" style="text-decoration: none;">
                    <div style="background: linear-gradient(135deg, #1e293b 0%, #475569 100%); border-radius: 1rem; padding: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.2s, box-shadow 0.2s;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 4rem; height: 4rem; background-color: rgba(255,255,255,0.2); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 2rem; height: 2rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-size: 1.25rem; font-weight: bold; color: white; margin-bottom: 0.25rem;">Profil Saya</h3>
                                <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">Kelola informasi akun dan foto profil</p>
                            </div>
                        </div>
                        <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: flex-end;">
                            <span style="display: inline-flex; align-items: center; font-size: 0.875rem; color: white;">
                                Edit Profil
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-left: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Info Section -->
            <div style="margin-top: 2rem; background-color: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                    <div style="width: 2.5rem; height: 2.5rem; background-color: #ede9fe; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; color: #7c3aed;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 style="font-size: 1rem; font-weight: 600; color: #111827;">Informasi Penting</h2>
                </div>
                <div style="background-color: #f5f3ff; border: 1px solid #c4b5fd; border-radius: 0.5rem; padding: 1rem;">
                    <p style="font-size: 0.875rem; color: #5b21b6;">
                        <strong>Program Mengaji:</strong> Sebagai anggota DEMA, Anda dapat mengikuti program mengaji sesuai jadwal yang tersedia. 
                        Silakan scan QR Code saat kegiatan berlangsung untuk mencatat kehadiran Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
