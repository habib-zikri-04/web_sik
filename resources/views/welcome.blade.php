<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sekolah Islam Kebangsaan - Pendidikan Integratif untuk Generasi Unggul</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="description" content="Sekolah Islam Kebangsaan mengintegrasikan nilai keislaman, semangat kebangsaan, dan teknologi modern untuk membentuk generasi berakhlak mulia dan kompetitif.">
</head>
<body class="bg-gray-50 text-gray-800">

{{-- NAVBAR --}}
<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
            <img src="{{ asset('images/logo.png') }}" class="h-12 w-auto" alt="Logo Sekolah Islam Kebangsaan">
            <div>
                <h1 class="font-bold text-lg text-lime-900">Sekolah Islam Kebangsaan</h1>
                <p class="text-xs text-gray-600 hidden md:block">Integritas • Ilmu • Iman</p>
            </div>
        </a>

        <div class="space-x-4">
            <a href="{{ route('login') }}" class="px-5 py-2.5 bg-lime-900 text-white rounded-lg hover:bg-lime-800 transition-colors font-medium shadow-md">
                Login Sistem Akademik
            </a>
        </div>
    </div>
</header>

{{-- HERO --}}
<section class="bg-gradient-to-br from-lime-900 via-lime-800 to-emerald-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-24 md:py-32 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
            Membangun Generasi <span class="text-lime-300">Unggul</span> Berlandaskan Islam dan Kebangsaan
        </h1>
        <p class="max-w-3xl mx-auto text-lg md:text-xl text-lime-100 mb-10 leading-relaxed">
            Sekolah Islam Kebangsaan hadir sebagai lembaga pendidikan terdepan yang mengintegrasikan
            <span class="font-semibold text-lime-300">nilai-nilai keislaman</span>,
            <span class="font-semibold text-lime-300">semangat kebangsaan</span>, dan
            <span class="font-semibold text-lime-300">teknologi pendidikan modern</span>
            dalam membentuk karakter dan kompetensi siswa.
        </p>

        <div class="mt-12 flex flex-col sm:flex-row justify-center gap-5">
            <a href="{{ route('login') }}"
               class="px-8 py-4 bg-white text-lime-900 font-bold rounded-xl hover:bg-lime-50 hover:shadow-2xl transition-all duration-300 shadow-lg text-lg">
                🚀 Masuk Sistem Akademik
            </a>
            <a href="#profil"
               class="px-8 py-4 border-2 border-white rounded-xl hover:bg-white/10 hover:border-lime-300 transition-all duration-300 font-medium">
                📖 Jelajahi Profil Sekolah
            </a>
        </div>


    </div>
</section>

{{-- PROFIL --}}
<section id="profil" class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Tentang <span class="text-lime-700">Sekolah Islam Kebangsaan</span></h2>
            <p class="max-w-3xl mx-auto text-gray-600 text-lg">
                Sebuah lembaga pendidikan inovatif yang berkomitmen membentuk generasi Muslim Indonesia
                yang unggul dalam ilmu, kuat dalam iman, dan cinta tanah air.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-900">Sekolah Islam Kebangsaaan</h3>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Sekolah Islam Kebangsaan (SIK) didirikan dengan visi jelas untuk menjawab tantangan
                    pendidikan di era modern. Kami tidak hanya fokus pada prestasi akademik, tetapi juga
                    pada pembentukan <span class="font-semibold text-lime-700">karakter Islami</span> dan
                    <span class="font-semibold text-lime-700">semangat nasionalisme</span>.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Dengan pendekatan pembelajaran yang holistik, kami memastikan setiap siswa berkembang
                    secara optimal dalam aspek kognitif, spiritual, emosional, dan sosial. Lingkungan
                    sekolah yang aman, nyaman, dan religius menjadi fondasi utama dalam proses belajar
                    mengajar.
                </p>


            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl font-bold text-lime-900 mb-3 flex items-center gap-2">
                            <span class="text-2xl">🎯</span> Visi Sekolah
                        </h3>
                        <p class="text-gray-700 bg-lime-50 p-5 rounded-xl leading-relaxed">
                            <span class="font-semibold text-lime-800">"Mencetak generasi Muslim Indonesia yang unggul, berakhlak mulia, berwawasan kebangsaan, dan kompetitif di era global."</span>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-lime-900 mb-3 flex items-center gap-2">
                            <span class="text-2xl">🚀</span> Misi Sekolah
                        </h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start gap-3">
                                <span class="bg-lime-100 text-lime-800 rounded-full p-1 mt-1">1</span>
                                <span>Menyelenggarakan pendidikan Islam terpadu yang mengintegrasikan nilai-nilai keislaman dengan kurikulum nasional</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="bg-lime-100 text-lime-800 rounded-full p-1 mt-1">2</span>
                                <span>Membangun karakter dan akhlak mulia melalui keteladanan dan pembiasaan positif</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="bg-lime-100 text-lime-800 rounded-full p-1 mt-1">3</span>
                                <span>Memanfaatkan teknologi pendidikan untuk meningkatkan kualitas pembelajaran</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="bg-lime-100 text-lime-800 rounded-full p-1 mt-1">4</span>
                                <span>Menumbuhkan kecintaan pada bangsa dan negara melalui penguatan nilai-nilai kebangsaan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM UNGGULAN --}}
<section class="bg-gradient-to-b from-gray-50 to-lime-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Program <span class="text-lime-700">Unggulan</span> Sekolah</h2>
            <p class="max-w-3xl mx-auto text-gray-600 text-lg">
                Berbagai program unggulan yang dirancang khusus untuk mengembangkan potensi siswa secara optimal.
            </p>
        </div>
    </div>
</section>

{{-- KEUNGGULAN --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Keunggulan <span class="text-lime-700">SIK</span></h2>
            <p class="max-w-3xl mx-auto text-gray-600 text-lg">
                Beberapa alasan mengapa SIK menjadi pilihan terbaik untuk pendidikan putra-putri Anda.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-white to-lime-50 p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="text-lime-700 text-3xl mb-5">👨‍🏫</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Guru Berkompeten dan Berakhlak</h3>
                <p class="text-gray-600 leading-relaxed">
                    Tenaga pendidik SIK tidak hanya memiliki kualifikasi akademik yang mumpuni, tetapi juga
                    akhlak yang menjadi teladan. Semua guru telah tersertifikasi dan mengikuti pelatihan
                    pengembangan metode pembelajaran modern secara berkala.
                </p>

            </div>

            <div class="bg-gradient-to-br from-white to-lime-50 p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="text-lime-700 text-3xl mb-5">💻</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sistem Akademik Digital Terpadu</h3>
                <p class="text-gray-600 leading-relaxed">
                    SIK menggunakan platform digital canggih untuk mendukung proses pembelajaran. Orang tua
                    dapat memantau perkembangan anak secara real-time melalui aplikasi khusus.
                </p>

            </div>

            <div class="bg-gradient-to-br from-white to-lime-50 p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="text-lime-700 text-3xl mb-5">📘</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Kurikulum Integratif Islam & Kebangsaan</h3>
                <p class="text-gray-600 leading-relaxed">
                    Kurikulum SIK memadukan kurikulum nasional dengan nilai-nilai keislaman dan kebangsaan.
                    Pendekatan pembelajaran kontekstual membantu siswa memahami relevansi ilmu dengan kehidupan.
                </p>

            </div>
        </div>


    </div>
</section>


</section>

{{-- FOOTER --}}
<footer class="bg-gray-900 text-gray-300 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" class="h-12 w-auto" alt="Logo SIK">
                    <div>
                        <h3 class="font-bold text-white text-lg">Sekolah Islam Kebangsaan</h3>
                        <p class="text-sm text-gray-400">Integritas • Ilmu • Iman</p>
                    </div>
                </div>
                <p class="text-sm text-gray-400">
                    Lembaga pendidikan unggulan yang mengintegrasikan nilai keislaman, semangat kebangsaan,
                    dan teknologi modern.
                </p>
            </div>





            
        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
            <p>© {{ date('Y') }} Sekolah Islam Kebangsaan. Hak Cipta Dilindungi.</p>
            <p class="mt-2">Dikembangkan dengan ❤️ untuk pendidikan Indonesia yang lebih baik.</p>
        </div>
    </div>
</footer>

</body>
</html>
