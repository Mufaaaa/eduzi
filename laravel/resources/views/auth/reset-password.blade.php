@extends('layout.app')

@section('title', 'Reset Password')

@section('content')

<div class="min-h-screen bg-[#f6f8f3] flex items-center justify-center px-6">

    <div class="bg-white rounded-3xl shadow-sm border border-[#eceee8] p-8 w-full max-w-md">

        <h2 class="text-3xl font-bold text-center text-[#2f3d35] mb-2">
            Reset Password
        </h2>

        <p class="text-center text-[#6e8178] mb-8">
            Masukkan password baru Anda.
        </p>

        @if ($errors->any())
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block mb-2 font-medium text-[#2f3d35]">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $email) }}"
                    readonly
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium text-[#2f3d35]">
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password baru"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#49a35a] focus:outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium text-[#2f3d35]">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Konfirmasi password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#49a35a] focus:outline-none">
            </div>

            <button
                type="submit"
                class="w-full bg-[#49a35a] hover:bg-[#3f8e4e] text-white font-bold py-3 rounded-full transition">
                Simpan Password Baru
            </button>

        </form>

    </div>

</div>

@endsection