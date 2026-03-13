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

<!-- JS -->
<script src="node_modules/flowbite/dist/flowbite.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
AOS.init();
</script>

</body>
</html>