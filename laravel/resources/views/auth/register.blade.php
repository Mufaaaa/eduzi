@extends('layout.app')

@section('title', 'Daftar')

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
                Bergabung dengan <span class="text-[#49a35a]">Eduzi</span>
            </h2>

            <p class="text-gray-600 text-base leading-relaxed">
                Mulai perjalanan Anda bersama Eduzi untuk memahami gizi seimbang
                dan mendukung tumbuh kembang anak yang sehat.
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
                    Buat akun baru untuk melanjutkan
                </p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-[#eceee8] p-6 md:p-8">
                
                <!-- Form -->
                <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-[#16352d] font-medium mb-3">
                            Nama
                        </label>
                        <div class="flex items-center gap-3 border border-[#d9dfd7] rounded-2xl px-4 py-4 bg-[#f8faf7]">
                            <i class="fa-regular fa-user text-[#7b8e84]"></i>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full bg-transparent outline-none text-[#16352d] placeholder:text-[#8ca096]"
                            >
                        </div>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

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
                        <label for="password" class="block text-[#16352d] font-medium mb-3">
                            Password
                        </label>
                        <div class="flex items-center gap-3 border border-[#d9dfd7] rounded-2xl px-4 py-4 bg-[#f8faf7]">
                            <i class="fa-solid fa-lock text-[#7b8e84]"></i>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
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

                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation" class="block text-[#16352d] font-medium mb-3">
                            Konfirmasi Password
                        </label>
                        <div class="flex items-center gap-3 border border-[#d9dfd7] rounded-2xl px-4 py-4 bg-[#f8faf7]">
                            <i class="fa-solid fa-lock text-[#7b8e84]"></i>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                class="w-full bg-transparent outline-none text-[#16352d] placeholder:text-[#8ca096]"
                            >
                            <button type="button" id="togglePasswordConfirmation" class="text-[#7b8e84] hover:text-[#49a35a] transition">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3">
                        <input
                            type="checkbox"
                            id="terms"
                            name="terms"
                            class="mt-1 w-4 h-4 rounded border-[#cfd8d3] text-[#49a35a] focus:ring-[#49a35a]"
                        >
                        <label for="terms" class="text-sm text-[#6e8178] leading-relaxed">
                            Saya menyetujui
                            <a href="/syarat-ketentuan" class="text-[#49a35a] font-medium hover:underline">
                                Syarat & Ketentuan
                            </a>
                            dan
                            <a href="/kebijakan-privasi" class="text-[#49a35a] font-medium hover:underline">
                                Kebijakan Privasi
                            </a>
                        </label>
                    </div>
                    @error('terms')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full bg-[#49a35a] hover:bg-[#3f8e4e] text-white font-bold py-4 rounded-full transition"
                    >
                        Daftar
                    </button>
                </form>
            </div>

            <!-- Bottom Text -->
            <p class="text-center text-[#6e8178] mt-8">
                Sudah punya akun?
                <a href="/masuk" class="text-[#49a35a] font-semibold hover:underline">
                    Masuk sekarang
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

    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    if (togglePasswordConfirmation && passwordConfirmationInput) {
        togglePasswordConfirmation.addEventListener('click', function () {
            const isPassword = passwordConfirmationInput.type === 'password';
            passwordConfirmationInput.type = isPassword ? 'text' : 'password';
            this.innerHTML = isPassword
                ? '<i class="fa-regular fa-eye-slash"></i>'
                : '<i class="fa-regular fa-eye"></i>';
        });
    }
</script>
@endsection