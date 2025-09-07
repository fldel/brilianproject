<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Brilian</title>
    @vite('resources/css/app.css')

    <style>
        /* Fullscreen video background */
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* biar di belakang konten */
        }

                /* Glass effect footer */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
        }

        /* Noise Overlay */
        .noise-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.40; /* atur transparansi */
            mix-blend-mode: overlay; /* biar nyatu sama video */
            pointer-events: none; /* biar gak ganggu klik */
            z-index: 0; /* pas di atas video, di bawah konten */
        }

        /* Black Overlay */
        .black-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* 50% hitam */
            z-index: 0; /* di atas video, di bawah konten */
        }

    </style>
</head>
<body class="flex flex-col min-h-screen text-gray-900">

    <!-- Video Background -->
    <video autoplay muted loop playsinline class="video-bg">
        <source src="{{ asset('videos/bgvid.mp4') }}" type="video/mp4">
    </video>

    <!-- Black Overlay -->
    <div class="black-overlay"></div>
    
    <!-- Header -->
    <header class="relative z-10 flex items-center justify-between px-8 py-4">
        <div class="flex items-center space-x-2">
            <x-application-logo></x-application-logo>
            <p class="text-white font-cave text-[30px]">BRILIAN</p>
        </div>

        <div class="space-x-3">
            @if (Route::has('login'))
                @auth
                    <x-pixel-button main-color="#B8860B" shadow-color="#B8860B" class="text-white"
                        onclick="window.location.href='{{ url('/dashboard') }}'">
                        Dashboard
                    </x-pixel-button>
                @else
                    <x-pixel-button main-color="#FFD82C" shadow-color="#B8860B" class="text-white"
                        onclick="window.location.href='{{ route('login') }}'">
                        Login
                    </x-pixel-button>

                    @if (Route::has('register'))
                        <x-pixel-button main-color="#4CAF50" shadow-color="#2E7D32" class="text-white"
                            onclick="window.location.href='{{ route('register') }}'">
                            Register
                        </x-pixel-button>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <main class="relative z-10 flex flex-col items-center justify-center flex-1 px-4 text-center">
        <p class="text-[36px] font-cave text-white/70">START YOUR</p>
        <h1 class="leading-[0.7] text-white tont-caveracking-wider font-cave text-[210px] drop-shadow">
            Scholarship <br> Adventure
        </h1> 
        <p class="text-[36px] font-cave text-white/70">Find your way easier find your dream scholarship</p>
    </main>

    <!-- Footer -->
    <footer class="relative flex justify-center w-full pb-6">
        <div class="flex items-center justify-between w-[90%] max-w-4xl px-6 py-4 text-sm font-medium text-white glass">
            <span>@2025 – All rights reserved</span>
            <span>created by fidelina affectine sweat</span>
        </div>
    </footer>

</body>
</html>
