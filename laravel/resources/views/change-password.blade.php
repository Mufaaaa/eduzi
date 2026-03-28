@extends('layout.password')

@section('title', 'Ganti Password')

@section('content')
<div class="wrapper">
    <div class="brand">
        <img src="{{ asset('images/Logo.png') }}" alt="Eduzi">
        <p>Perbarui kata sandi akun Anda</p>
    </div>

    <div class="card">
        <h2>Ganti Kata Sandi</h2>
        <p class="subtitle">Masukkan kata sandi lama dan kata sandi baru Anda</p>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="current_password">Kata Sandi Lama</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        placeholder="Masukkan kata sandi lama"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('current_password', this)">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                @error('current_password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password">Kata Sandi Baru</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="new_password"
                        name="new_password"
                        placeholder="Masukkan kata sandi baru"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('new_password', this)">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                @error('new_password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Konfirmasi Kata Sandi Baru</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        placeholder="Ulangi kata sandi baru"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('new_password_confirmation', this)">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Perbarui Kata Sandi
            </button>
        </form>

        <a href="/home" class="back-link">← Kembali</a>
    </div>
</div>
@endsection