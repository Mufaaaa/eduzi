<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'Laravel App')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f4f6ef] text-slate-800 font-[Poppins]">
    <div class="min-h-screen px-5 py-12">
        @yield('content')
    </div>

    <details class="fixed bottom-6 right-6 z-50">
        <summary class="list-none cursor-pointer">
            <span class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-white shadow-lg border border-slate-200 hover:scale-105 transition">
                <img src="{{ asset('images/Logo.png') }}" alt="Chat" class="h-8 w-8">
            </span>
        </summary>

        <div class="mt-3 w-[min(420px,90vw)] h-[min(560px,75vh)] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl">
            <deep-chat
                id="deepchat"
                class="block h-full w-full"
                style="height:100%;width:100%;"
                textInput='{"placeholder":{"text":"Tanya apa aja di sini..."}}'
                introMessage='{"text":"Selamat datang di asisten Eduzi 👋"}'
                avatars='{
                  "ai": { "src": "{{ asset('images/Logo.png') }}", "shape": "circle", "size": "30px" },
                  "user": { "color": "#facc15", "shape": "circle", "size": "30px" }
                }'
                connect='{
                  "url": "/deep-chat",
                  "method": "POST",
                  "headers": { "X-Requested-With": "XMLHttpRequest" }
                }'
            ></deep-chat>
        </div>
    </details>

    @stack('scripts')
</body>
</html>