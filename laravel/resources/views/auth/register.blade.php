@extends('layout.app')

@section('title', 'Daftar')

@section('content')
<div class="min-h-screen bg-[#f6f8f3] grid grid-cols-1 lg:grid-cols-2">
    
    <x-auth-banner />

    <div class="flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-md mx-auto">

            <div class="flex justify-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 text-sm text-[#49a35a] hover:underline">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="flex flex-col items-center mb-8 lg:hidden">
                <img src="{{ asset('images/EDUZI NEW LOGO.png') }}" alt="Logo Eduzi" class="w-20 h-20 object-contain mb-4">
            </div>

            <div class="text-center mb-8">
                <p class="text-[#6e8178] text-base">Buat akun baru untuk melanjutkan</p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-[#eceee8] p-6 md:p-8">
                <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <x-auth-input 
                        id="name" 
                        name="name" 
                        label="Nama" 
                        icon="fa-regular fa-user" 
                        placeholder="Masukkan nama lengkap" 
                        :value="old('name')" 
                    />

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
                        label="Password" 
                        icon="fa-solid fa-lock" 
                        placeholder="Masukkan password"
                    >
                        <x-slot:append>
                            <button type="button" id="togglePassword" class="text-[#7b8e84] hover:text-[#49a35a] transition">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </x-slot:append>
                    </x-auth-input>

                    <x-auth-input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        label="Konfirmasi Password" 
                        icon="fa-solid fa-lock" 
                        placeholder="Ulangi password"
                    >
                        <x-slot:append>
                            <button type="button" id="togglePasswordConfirmation" class="text-[#7b8e84] hover:text-[#49a35a] transition">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </x-slot:append>
                    </x-auth-input>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="terms" name="terms" 
                                   class="mt-1 w-4 h-4 rounded border-[#cfd8d3] text-[#49a35a] focus:ring-[#49a35a]">
                            <label for="terms" class="text-sm text-[#6e8178] leading-relaxed">
                                Saya menyetujui 
                                <a href="/syarat-ketentuan" class="text-[#49a35a] font-medium hover:underline">Syarat & Ketentuan</a> 
                                dan 
                                <a href="/kebijakan-privasi" class="text-[#49a35a] font-medium hover:underline">Kebijakan Privasi</a>
                            </label>
                        </div>
                        @error('terms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#49a35a] hover:bg-[#3f8e4e] text-white font-bold py-4 rounded-full transition shadow-sm">
                        Daftar
                    </button>
                </form>
            </div>

            <p class="text-center text-[#6e8178] mt-8">
                Sudah punya akun?
                <a href="/masuk" class="text-[#49a35a] font-semibold hover:underline">Masuk sekarang</a>
            </p>
        </div>
    </div>
</div>

<script>
    // Logic untuk toggle show/hide password utama
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

    // Logic untuk toggle show/hide konfirmasi password
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