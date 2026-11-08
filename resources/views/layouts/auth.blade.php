<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#0a0f12] text-slate-200 antialiased font-mono">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <!-- Tailwind CSS (Instant styling without npm/Node.js) -->
    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-[#0a0f12] text-slate-200">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <h2 class="text-2xl font-bold tracking-tight text-emerald-400 font-mono">{{ config('app.name', 'Laravel') }}</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
        <div class="bg-[#11181c] border border-emerald-500/25 rounded-xl p-6 sm:p-8 shadow-2xl shadow-emerald-950/40 font-mono">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </div>
</body>
</html>
