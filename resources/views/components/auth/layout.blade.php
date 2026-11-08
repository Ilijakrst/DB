@props([
    'title' => 'Authentication',
    'subtitle' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#0a0f12] text-slate-200 antialiased font-mono">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts and Styles (Tailwind CDN for instant styling + Vite when compiled) -->
    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-[#0a0f12] selection:bg-emerald-500 selection:text-slate-950">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="/" class="inline-flex items-center gap-3 group focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 rounded-2xl" aria-label="Go to homepage">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-600 via-teal-500 to-emerald-500 flex items-center justify-center shadow-xl shadow-emerald-500/20 group-hover:scale-105 transition-transform duration-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
        </a>
        <h1 class="mt-4 text-2xl font-bold tracking-tight text-emerald-400 font-mono">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-1 text-sm text-emerald-400/60 font-mono text-xs">{{ $subtitle }}</p>
        @endif
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <div class="bg-[#11181c] border border-emerald-500/25 rounded-xl p-6 sm:p-8 shadow-2xl shadow-emerald-950/40 space-y-6 font-mono">
            @if (session('status'))
                <x-auth.alert type="success" :message="session('status')" />
            @endif

            <x-auth.validation-errors />

            {{ $slot }}
        </div>
    </div>
</body>
</html>
