@extends('layout.password')

@section('title', 'Ganti Password')

@section('content')
<div class="w-full max-w-xl">
    <div class="mb-6 text-center">
        <img src="{{ asset('images/Logo.png') }}" alt="Eduzi" class="mx-auto mb-3 h-16 max-w-32 object-contain">
        <p class="text-2xl text-[#6c7a72]">Perbarui kata sandi akun Anda</p>
    </div>

    <div class="rounded-2xl bg-white p-8 shadow-[0_10px_25px_rgba(0,0,0,0.05)]">
        <h2 class="mb-2 text-2xl font-semibold text-[#142020]">Ganti Kata Sandi</h2>
        <p class="mb-6 text-base text-[#75847d]">Masukkan kata sandi lama dan kata sandi baru Anda</p>

        @if(session('success'))
            <div class="mb-4 rounded-xl border border-[#bfe7cd] bg-[#e8f7ee] px-4 py-3 text-sm text-[#246b45]">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Menggunakan komponen baru untuk masing-masing field --}}
            <x-form-password 
                id="current_password" 
                name="current_password" 
                label="Kata Sandi Lama" 
                placeholder="Masukkan kata sandi lama" 
            />

            <x-form-password 
                id="new_password" 
                name="new_password" 
                label="Kata Sandi Baru" 
                placeholder="Masukkan kata sandi baru" 
            />

            <x-form-password 
                id="new_password_confirmation" 
                name="new_password_confirmation" 
                label="Konfirmasi Kata Sandi Baru" 
                placeholder="Ulangi kata sandi baru" 
            />

            <button type="submit" class="mt-2 h-14 w-full rounded-full bg-emerald-500 text-[18px] font-bold text-white transition hover:bg-emerald-600">
                Perbarui Kata Sandi
            </button>
        </form>

        <a href="/home" class="mt-6 block text-center text-[18px] text-[#142020] hover:underline">
            ← Kembali
        </a>
    </div>
</div>
@endsection