<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>@yield('title', 'Laravel App')</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">

  <!-- Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-white antialiased">

{{-- Konten utama --}}
@yield('content')

<details class="chat-toggle fixed bottom-6 right-6 z-50">
  {{-- Tombol logo (toggle) --}}
  <summary class="list-none cursor-pointer">
    <span class="inline-flex h-14 w-14 items-center justify-center rounded-full border border-white/20 bg-white shadow-lg hover:scale-105 transition">
      <img src="{{ asset('images/Logo.png') }}" alt="Chat" class="h-8 w-8">
    </span>
  </summary>

  {{-- Panel chat --}}
  <div
    class="mt-3 w-[min(420px,90vw)] h-[min(560px,75vh)] rounded-2xl overflow-hidden shadow-2xl
           bg-white text-slate-900 border border-slate-200">
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

<!-- JS -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
AOS.init();
</script>

</body>
</html>