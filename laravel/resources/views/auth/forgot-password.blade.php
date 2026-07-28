@extends('layout.app')

@section('title','Lupa Password')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-[#f6f8f3]">

    <div class="bg-white p-8 rounded-3xl shadow w-full max-w-md">

        <h2 class="text-2xl font-bold text-center mb-3">
            Lupa Password
        </h2>

        <p class="text-center text-gray-500 mb-6">
            Masukkan email akun Anda.
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input
                type="email"
                name="email"
                class="w-full border rounded-xl px-4 py-3 mb-3"
                placeholder="Email"
                required>

            @error('email')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <button
                class="w-full bg-[#49a35a] text-white py-3 rounded-full">
                Kirim Link Reset Password
            </button>

        </form>

    </div>

</div>

@endsection