@extends('layout.app')

@section('title', 'Masuk')

@section('content')
<div class="min-h-screen bg-[#f6f8f3] grid grid-cols-1 lg:grid-cols-2">
    
    <!-- Left Side -->
    <x-auth-banner />

    <!-- Right Side -->
    <div class="flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-md mx-auto">

            <!-- Kembali -->
            <div class="flex justify-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 text-sm text-[#49a35a] hover:underline">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

            <!-- Logo Mobile -->
            <div class="flex flex-col items-center mb-8 lg:hidden">
                <img src="{{ asset('images/EDUZI NEW LOGO.png') }}" alt="Logo Eduzi" class="w-20 h-20 object-contain mb-4">
            </div>

            <!-- Heading -->
             
            <div class="text-center mb-8">
                <p class="text-[#6e8178] text-base">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-[#eceee8] p-6 md:p-8">
                
                <x-google-button>Masuk dengan Google</x-google-button>

                <div class="flex items-center gap-4 my-8">
                    <div class="h-px bg-[#d9dfd7] flex-1"></div>
                    <span class="text-[#6e8178] text-sm">atau</span>
                    <div class="h-px bg-[#d9dfd7] flex-1"></div>
                </div>

                <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <x-auth-input 
                        id="email" 
                        name="email" 
                        type="email" 
                        label="Email" 
                        icon="fa-regular fa-envelope" 
                        placeholder="nama@email.com" 
                        :value="old('email')" 
                    />

                    <x-auth-input 
                        id="password" 
                        name="password" 
                        type="password" 
                        label="Kata Sandi" 
                        icon="fa-solid fa-lock" 
                        placeholder="Masukkan kata sandi"
                    >
                        <x-slot:labelLink>
                            <a href="#" class="text-[#49a35a] text-sm hover:underline">Lupa kata sandi?</a>
                        </x-slot:labelLink>

                        <x-slot:append>
                            <button type="button" id="togglePassword" class="text-[#7b8e84] hover:text-[#49a35a] transition">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </x-slot:append>
                    </x-auth-input>

                    @if (session('error'))
                        <p class="text-red-500 text-sm animate-fade-in">{{ session('error') }}</p>
                    @endif

                    @if (session('success'))
                        <p class="text-green-600 text-sm animate-fade-in">{{ session('success') }}</p>
                    @endif

                    <button type="submit" class="w-full bg-[#49a35a] hover:bg-[#3f8e4e] text-white font-bold py-4 rounded-full transition shadow-sm">
                        Masuk
                    </button>
                </form>
            </div>

            <p class="text-center text-[#6e8178] mt-8">
                Belum punya akun?
                <a href="/daftar" class="text-[#49a35a] font-semibold hover:underline">Daftar sekarang</a>
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