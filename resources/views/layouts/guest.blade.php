<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #f3f4f6; /* Light gray background for the whole page */
                font-family: 'Figtree', sans-serif;
            }

            /* Maroon Header */
            .header-nav {
                background: linear-gradient(to bottom, #7f1d1d, #450a0a);
                color: white;
                padding: 10px 10%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            }

            .header-left {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .header-logo {
                width: 45px;
                height: 45px;
                object-fit: contain;
            }

            .header-title-main {
                font-weight: bold;
                font-size: 1.25rem;
                margin: 0;
            }

            .header-title-sub {
                font-size: 0.8rem;
                margin: 0;
                opacity: 0.9;
            }

            .header-right {
                text-align: right;
                font-size: 0.75rem;
            }

            /* Main Content Container */
            .main-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding-top: 40px;
                position: relative;
            }

            /* Hero Image Area */
            .hero-image-container {
                width: 70%;
                max-width: 900px;
                height: auto;
                aspect-ratio: 16/10;
                background-image: url('{{ asset('images/fix.jpg') }}');
                background-size: cover;
                background-position: center;
                border-radius: 4px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            /* Login Card Overlap */
            .login-card-wrapper {
                position: absolute;
                bottom: -150px; /* Overlap effect */
                width: 450px;
                background: white;
                padding: 40px;
                border: 1px solid #e5e7eb;
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                z-index: 20;
            }

            @media (max-width: 768px) {
                .hero-image-container {
                    width: 95%;
                }
                .login-card-wrapper {
                    width: 90%;
                    bottom: -200px;
                    padding: 20px;
                }
                .main-content {
                    padding-bottom: 250px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Top Maroon Header -->
        <header class="header-nav">
            <a href="/" class="header-left" style="text-decoration: none; color: inherit; cursor: pointer;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="header-logo">
                <div>
                    <h1 class="header-title-main">Sekolah Islam Kebangsaan</h1>
                    <p class="header-title-sub">FST UIN IB Padang</p>
                </div>
            </a>
            <div class="header-right">
                <p style="margin: 0; font-weight: 500;">Jadwal: SIK Terjadwal</p>
                <p style="margin: 0; opacity: 0.8;">Sesuai Kalender Akademik</p>
            </div>
        </header>

        <div class="main-content">
            <!-- Center Image -->
            <div class="hero-image-container">
            </div>

            <!-- Login Card Container -->
            <div class="login-card-wrapper">
                {{ $slot }}
            </div>
        </div>

        <!-- Spacer for footer/overlap -->
        <div style="height: 250px;"></div>

        @stack('scripts')
    </body>
</html>
