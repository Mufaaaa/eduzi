@extends('layout.password')

@section('title', 'Ganti Password')

@section('content')
<div class="w-full max-w-[560px]">
    <div class="mb-6 text-center">
        <img
            src="{{ asset('images/Logo.png') }}"
            alt="Eduzi"
            class="mx-auto mb-3 h-[60px] max-w-[120px] object-contain"
        >
        <p class="text-[22px] text-[#6c7a72]">
            Perbarui kata sandi akun Anda
        </p>
    </div>

    <div class="rounded-[18px] bg-white p-[30px] shadow-[0_10px_25px_rgba(0,0,0,0.05)]">
        <h2 class="mb-2 text-[22px] font-semibold text-[#142020]">Ganti Kata Sandi</h2>
        <p class="mb-6 text-[16px] text-[#75847d]">
            Masukkan kata sandi lama dan kata sandi baru Anda
        </p>

        @if(session('success'))
            <div class="mb-4 rounded-xl border border-[#bfe7cd] bg-[#e8f7ee] px-4 py-3 text-sm text-[#246b45]">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="current_password" class="mb-2 block text-base font-semibold text-[#162323]">
                    Kata Sandi Lama
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        placeholder="Masukkan kata sandi lama"
                        required
                        class="h-[54px] w-full rounded-[14px] border border-[#d7dfd8] bg-[#f8faf7] px-4 pr-12 text-base text-[#223030] outline-none transition focus:border-[#86c8a5] focus:bg-white"
                    >
                    <button
                        type="button"
                        class="absolute right-[14px] top-1/2 -translate-y-1/2 border-0 bg-transparent text-base text-[#738279]"
                        onclick="togglePassword('current_password', this)"
                    >
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                @error('current_password')
                    <div class="mt-2 text-[13px] text-[#d93025]">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="new_password" class="mb-2 block text-base font-semibold text-[#162323]">
                    Kata Sandi Baru
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="new_password"
                        name="new_password"
                        placeholder="Masukkan kata sandi baru"
                        required
                        class="h-[54px] w-full rounded-[14px] border border-[#d7dfd8] bg-[#f8faf7] px-4 pr-12 text-base text-[#223030] outline-none transition focus:border-[#86c8a5] focus:bg-white"
                    >
                    <button
                        type="button"
                        class="absolute right-[14px] top-1/2 -translate-y-1/2 border-0 bg-transparent text-base text-[#738279]"
                        onclick="togglePassword('new_password', this)"
                    >
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                @error('new_password')
                    <div class="mt-2 text-[13px] text-[#d93025]">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="new_password_confirmation" class="mb-2 block text-base font-semibold text-[#162323]">
                    Konfirmasi Kata Sandi Baru
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        placeholder="Ulangi kata sandi baru"
                        required
                        class="h-[54px] w-full rounded-[14px] border border-[#d7dfd8] bg-[#f8faf7] px-4 pr-12 text-base text-[#223030] outline-none transition focus:border-[#86c8a5] focus:bg-white"
                    >
                    <button
                        type="button"
                        class="absolute right-[14px] top-1/2 -translate-y-1/2 border-0 bg-transparent text-base text-[#738279]"
                        onclick="togglePassword('new_password_confirmation', this)"
                    >
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <button
                type="submit"
                class="mt-2 h-[56px] w-full rounded-full bg-[#9ed1b1] text-[18px] font-bold text-white transition hover:bg-[#88c59d]"
            >
                Perbarui Kata Sandi
            </button>
        </form>

        <a
            href="/home"
            class="mt-6 block text-center text-[18px] text-[#142020]"
        >
            ← Kembali
        </a>
    </div>
</div>
@endsection