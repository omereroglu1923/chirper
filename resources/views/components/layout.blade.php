<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- $title varsa "X - Chirper" yaz, yoksa sadece "Chirper" --}}
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    {{-- DaisyUI: Tailwind üzerine hazır bileşen/tema kütüphanesi --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    {{-- Vite: CSS/JS dosyalarını derleyip bu sayfaya bağlar --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    {{-- Nav: her sayfada aynı görünen sabit üst bar --}}
    <div class="navbar-end gap-2">
        @auth
            <span class="text-sm">{{ auth()->user()->name }}</span>
            <form method="POST" action="/logout" class="inline">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm">Logout</button>
            </form>
        @else
            <a href="/login" class="btn btn-ghost btn-sm">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
        @endauth
    </div>
    @if (session('success'))
        <div class="toast toast-top toast-center">
            <div class="alert alert-success animate-fade-out">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    <main class="flex-1 container mx-auto px-4 py-8">
        {{-- Bu layout'u kullanan sayfanın (örn. home.blade.php) tüm içeriği buraya girer --}}
        {{ $slot }}
    </main>

    {{-- Footer: her sayfada aynı, sabit alt bar --}}
    <footer class="footer footer-center p-5 bg-base-300 text-base-content text-xs">
        <div>
            <p>© {{ date('Y') }} Chirper - Built with Laravel and ❤️</p>
        </div>
    </footer>
</body>

</html>
