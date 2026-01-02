<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Islam Kebangsaan - FST UIN IB Padang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Subtle Pattern Background */
        .pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23581414' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .bg-maroon {
            background-color: #581414;
        }

        .hero-section {
            background: linear-gradient(135deg, #581414 0%, #3d0e0e 100%);
            padding: 120px 0 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero-image-container {
            width: 85%;
            max-width: 900px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transform: perspective(1000px) rotateX(2deg);
            transition: transform 0.5s ease;
        }

        .hero-image-container:hover {
            transform: perspective(1000px) rotateX(0deg) scale(1.02);
        }

        .sik-info-box {
            background: rgba(6, 78, 59, 1);
            backdrop-filter: blur(10px);
            color: white;
            padding: 40px 60px;
            border-radius: 24px;
            text-align: center;
            max-width: 1000px;
            margin: -60px auto 60px;
            position: relative;
            z-index: 10;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-title-box {
            background: white;
            border: 2px solid #f1f5f9;
            padding: 20px 40px;
            text-align: center;
            max-width: 900px;
            margin: 60px auto;
            font-size: 28px;
            font-weight: 800;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            letter-spacing: -0.025em;
        }

        .informasi-section {
            background-color: #581414;
            box-shadow: inset 0 2px 20px rgba(0, 0, 0, 0.2);
        }

        .informasi-header {
            background-color: #fcc419;
            color: #333;
            padding: 10px 40px;
            border-radius: 10px;
            font-weight: 800;
            display: inline-block;
            margin-bottom: 60px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-size: 24px;
        }

        .poster-card {
            background: #fff;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 320px;
            transition: all 0.3s ease;
        }

        .poster-card:hover {
            transform: translateY(-5px);
        }

        .poster-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #fcc419;
        }

        .footer {
            background-color: #0f172a;
            color: #94a3b8;
            padding: 40px 0;
            text-align: center;
            font-size: 13px;
            border-top: 1px solid #1e293b;
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 h-[80px] flex items-center px-4 md:px-10 text-white" 
         style="background: linear-gradient(90deg, #7c0a0a 0%, #7c0a0a 70%, #2a2a2a 100%);">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}" class="h-14 w-auto" alt="Logo">
            <div class="flex flex-col">
                <h1 class="font-bold text-xl leading-none">Sekolah Islam Kebangsaan</h1>
                <div class="flex items-center gap-2 mt-1">
                    <p class="text-[11px] text-gray-300">FST UIN IB Padang</p>
                    <span class="w-1 h-1 rounded-full bg-yellow-500"></span>
                    <p class="text-[11px] text-yellow-500 font-bold tracking-wider uppercase">Iman, Ilmu, Amal</p>
                </div>
            </div>
        </div>
        
        <div class="ml-auto flex items-center gap-8">
            <div class="text-right hidden sm:block">
                <p class="text-[10px] text-gray-300 leading-tight">Jadwal: SIK Terjadwal</p>
                <p class="text-[11px] font-bold text-white">Sesuai Kalender Akademik</p>
            </div>
            <a href="{{ route('login') }}" class="flex items-center justify-center w-10 h-10 rounded-full border border-white/20 bg-white/10 text-white hover:bg-white/20 hover:border-white transition-all shadow-sm" title="Login ke Sistem">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m12 0l-4-4m4 4l-4 4" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5.5A8 8 0 118 18.5" />
                </svg>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section pattern-bg">
        <div class="hero-image-container reveal active floating">
            <img src="{{ asset('images/fix.jpg') }}" class="w-full h-auto" alt="Banner SIK">
        </div>
    </header>

    <!-- SIK Info Box -->
    <section class="px-6 reveal">
        <div class="sik-info-box shadow-2xl">
            <h2 class="text-3xl font-extrabold mb-6 tracking-tight">SIK</h2>
            <div class="space-y-6 text-base leading-relaxed font-medium">
                <p>
                    Merupakan sebuah rangkaian kegiatan sistematik yang dirancang untuk mengatur penyelenggaraan pendidikan di Sekolah Islam Kebangsaan (SIK), mulai dari tahap perencanaan kurikulum, pembinaan karakter, pelaksanaan pembelajaran, hingga evaluasi capaian peserta didik secara menyeluruh.
                </p>
                <p>
                    Penyelenggaraan SIK berfokus pada penguatan nilai keimanan, kethoatan, kedisiplinan, dan kebangsaan, yang terintegrasi dalam seluruh aspek pembelajaran dan kehidupan sekolah. Setiap kegiatan dirancang untuk membentuk pribadi yang berakhlak mulia, berwawasan kebangsaan, serta memiliki pemahaman Islam yang rahmatan lil 'alamin.
                </p>
                <p>
                    SIK dilaksanakan secara objektif, transparan, dan akuntabel, dengan pendekatan holistik yang mencakup aspek spiritual, intelektual, emosional, dan sosial. Penyelenggaraan kegiatan dimulai sejak awal tahun ajaran dan berlangsung secara berkelanjutan, dengan evaluasi berkala untuk memastikan kualitas dan relevansi pendidikan terhadap perkembangan zaman.
                </p>
            </div>
        </div>
    </section>

    <!-- Informasi Section -->
    <section class="informasi-section max-w-full py-20 text-center mb-24 relative reveal">
        <div class="informasi-header">
            Informasi
        </div>
        
        <div class="max-w-7xl mx-auto px-6 relative">
            <!-- Navigation arrows -->
            <button class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-gold/90 p-2 rounded-full text-white shadow-lg border-2 border-white/20 hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="flex justify-center gap-8 items-center">
                <!-- Card 1 -->
                <div class="poster-card">
                    <img src="{{ asset('images/berita.png') }}" class="w-full h-auto rounded-lg" alt="Poster Informasi">
                </div>

                <!-- Card 2 -->
                <div class="poster-card">
                    <img src="{{ asset('images/berita.png') }}" class="w-full h-auto rounded-lg" alt="Poster Informasi">
                </div>

                <!-- Card 3 -->
                <div class="poster-card">
                    <img src="{{ asset('images/berita.png') }}" class="w-full h-auto rounded-lg" alt="Poster Informasi">
                </div>
            </div>

            <button class="absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-gold/90 p-2 rounded-full text-white shadow-lg border-2 border-white/20 hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-6">
            <p class="font-bold text-white mb-2">© 2026 Sekolah Islam Kebangsaan - FST UIN IB Padang</p>
            <p class="text-sm">Program Pendidikan Islam Mingguan</p>
            <div class="mt-6 flex justify-center gap-6">
                <span class="w-2 h-2 rounded-full bg-maroon/40"></span>
                <span class="w-2 h-2 rounded-full bg-gold/40"></span>
                <span class="w-2 h-2 rounded-full bg-emerald-900/40"></span>
            </div>
        </div>
    </footer>

    <!-- Audio Element -->
    <audio id="bgMusic" loop>
        <source src="{{ asset('asset/audio/Itiraf.mp3') }}" type="audio/mpeg">
        Browser Anda tidak mendukung elemen audio.
    </audio>

    <!-- Music Control Button -->
    <button id="musicToggle" 
            style="position: fixed; bottom: 30px; left: 30px; z-index: 9999; width: 50px; height: 50px; border-radius: 50%; background: #581414; color: white; border: 2px solid white; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.3); transition: all 0.3s ease;"
            title="Putar/Heningkan Musik">
        <svg id="musicIcon" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path id="iconPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
            <path id="mutePath" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-12.728 12.728" />
        </svg>
    </button>

    <script>
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        reveal();

        // Music Control Logic
        const audio = document.getElementById('bgMusic');
        const btn = document.getElementById('musicToggle');
        const mutePath = document.getElementById('mutePath');

        btn.addEventListener('click', function() {
            if (audio.paused) {
                audio.play();
                mutePath.style.display = 'none';
                btn.style.backgroundColor = '#581414';
                btn.style.boxShadow = '0 4px 20px rgba(88, 20, 20, 0.4)';
            } else {
                audio.pause();
                mutePath.style.display = 'block';
                btn.style.backgroundColor = '#64748b';
                btn.style.boxShadow = 'none';
            }
        });

        // Optional: Auto-play might be blocked by browsers until first interaction
        // This button acts as that first interaction
    </script>
</body>
</html>
