<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'Laravel App')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/Logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body.auth-page {
            background: #f4f6ef;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1f2a2a;
        }

        .wrapper {
            width: 100%;
            max-width: 560px;
            padding: 20px;
        }

        .brand {
            text-align: center;
            margin-bottom: 24px;
        }

        .brand img {
            height: 60px;
            margin-bottom: 10px;
            display: block;
            margin: 0 auto 10px;
            max-width: 120px;
        }

        .brand p {
            color: #6c7a72;
            font-size: 22px;
        }

        .card {
            background: #fff;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .card h2 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #142020;
        }

        .card .subtitle {
            font-size: 16px;
            color: #75847d;
            margin-bottom: 26px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 600;
            color: #162323;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            height: 54px;
            border: 1px solid #d7dfd8;
            border-radius: 14px;
            padding: 0 50px 0 16px;
            outline: none;
            font-size: 16px;
            color: #223030;
            background: #f8faf7;
        }

        .input-wrap input:focus {
            border-color: #86c8a5;
            background: #fff;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #738279;
        }

        .btn-submit {
            width: 100%;
            height: 56px;
            border: none;
            border-radius: 999px;
            background: #9ed1b1;
            color: white;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #88c59d;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            text-decoration: none;
            color: #142020;
            font-size: 18px;
        }

        .alert-success {
            background: #e8f7ee;
            border: 1px solid #bfe7cd;
            color: #246b45;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .error-text {
            color: #d93025;
            font-size: 13px;
            margin-top: 8px;
        }

        @media (max-width: 640px) {
            .brand p {
                font-size: 18px;
            }

            .card {
                padding: 22px;
            }
        }
    </style>
</head>

<body class="auth-page">
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

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();

        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>