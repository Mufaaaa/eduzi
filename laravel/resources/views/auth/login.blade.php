@extends('layout.app')

@section('title', 'Masuk')

@section('content')
<div class="min-h-screen bg-[#f6f8f3] grid grid-cols-1 lg:grid-cols-2">
    
    <!-- Left Side -->
    <div class="hidden lg:flex bg-[#eaf6ee] items-center justify-center px-10 py-12">
        <div class="text-center max-w-md">
            <img 
                src="{{ asset('images/Logo.png') }}" 
                alt="Logo Eduzi" 
                class="w-28 h-28 object-contain mx-auto mb-6"
            >

            <h2 class="text-3xl font-bold mb-4 text-[#1f3b2f]">
                Selamat Datang di <span class="text-[#49a35a]">Eduzi</span>
            </h2>

            <p class="text-gray-600 text-base leading-relaxed">
                Platform edukasi gizi digital untuk membantu orang tua memahami 
                gizi seimbang dan mencegah stunting pada anak sejak dini.
            </p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-md mx-auto">

            <!-- Kembali -->
            <div class="flex justify-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 text-sm text-[#49a35a] hover:underline">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Logo Mobile -->
            <div class="flex flex-col items-center mb-8 lg:hidden">
                <img 
                    src="{{ asset('images/Logo.png') }}" 
                    alt="Logo Eduzi"
                    class="w-20 h-20 object-contain mb-4"
                >
            </div>

            <!-- Heading -->
            <div class="text-center mb-8">
                <p class="text-[#6e8178] text-base">
                    Masuk ke akun Anda untuk melanjutkan
                </p>
            </div>

             <!-- Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-[#eceee8] p-6 md:p-8">
                
                <!-- Google Button -->
                <a
                    href="{{ route('google.login') }}"
                    class="w-full flex items-center justify-center gap-3 border border-[#d9dfd7] bg-[#f8faf7] rounded-2xl py-4 text-[#18342d] font-semibold hover:bg-[#f3f6f1] transition"
                >
                    <img 
                        src="https://www.svgrepo.com/show/475656/google-color.svg" 
                        alt="Google"
                        class="w-5 h-5"
                    >
                    Masuk dengan Google
                </a>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-8">
                    <div class="h-px bg-[#d9dfd7] flex-1"></div>
                    <span class="text-[#6e8178] text-sm">atau</span>
                    <div class="h-px bg-[#d9dfd7] flex-1"></div>
                </div>

                <!-- Form -->
                <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-[#16352d] font-medium mb-3">
                            Email
                        </label>
                        <div class="flex items-center gap-3 border border-[#d9dfd7] rounded-2xl px-4 py-4 bg-[#f8faf7]">
                            <i class="fa-regular fa-envelope text-[#7b8e84]"></i>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                class="w-full bg-transparent outline-none text-[#16352d] placeholder:text-[#8ca096]"
                            >
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label for="password" class="block text-[#16352d] font-medium">
                                Kata Sandi
                            </label>
                            <a href="#" class="text-[#49a35a] text-sm hover:underline">
                                Lupa kata sandi?
                            </a>
                        </div>

                        <div class="flex items-center gap-3 border border-[#d9dfd7] rounded-2xl px-4 py-4 bg-[#f8faf7]">
                            <i class="fa-solid fa-lock text-[#7b8e84]"></i>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                class="w-full bg-transparent outline-none text-[#16352d] placeholder:text-[#8ca096]"
                            >
                            <button type="button" id="togglePassword" class="text-[#7b8e84] hover:text-[#49a35a] transition">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (session('error'))
                        <p class="text-red-500 text-sm">{{ session('error') }}</p>
                    @endif

                    @if (session('success'))
                        <p class="text-green-600 text-sm">{{ session('success') }}</p>
                    @endif

                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full bg-[#49a35a] hover:bg-[#3f8e4e] text-white font-bold py-4 rounded-full transition"
                    >
                        Masuk
                    </button>
                </form>
            </div>

              <!-- Bottom Text -->
            <p class="text-center text-[#6e8178] mt-8">
                Belum punya akun?
                <a href="/daftar" class="text-[#49a35a] font-semibold hover:underline">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            this.innerHTML = isPassword
                ? '<i class="fa-regular fa-eye-slash"></i>'
                : '<i class="fa-regular fa-eye"></i>';
        });
    }
</script>
@endsection