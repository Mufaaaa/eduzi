@extends('layout.profile')

@section('title', 'Profil')

@section('content')

@php
    $photo = $user->photo ?? $user->avatar;
    $isGooglePhoto = $photo ? filter_var($photo, FILTER_VALIDATE_URL) : false;
@endphp

<div class="mx-auto max-w-5xl">

    <div class="mb-10 text-center">
        <div class="mb-4 inline-block rounded-full bg-green-100 px-4 py-2 text-sm font-medium text-green-600">
            Profil
        </div>

        <h1 class="text-3xl font-bold leading-tight text-slate-900 md:text-5xl">
            Sesuaikan <span class="text-green-500">Data</span> Akun Anda
        </h1>

        <p class="mx-auto mt-3 max-w-2xl text-sm leading-7 text-slate-500 md:text-base">
            Anda dapat mengubah informasi data terkait akun
            <br class="hidden md:block">
            Anda pada profil disini.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-10">
        <div class="flex flex-col items-center gap-8 md:flex-row">

            <div class="w-full text-center md:w-64">
                <img id="preview-image"
                    src="{{ $photo 
                            ? ($isGooglePhoto 
                                ? $photo 
                                : asset('storage/' . $photo)) 
                            : asset('images/default-user.png') }}"
                    class="mx-auto h-44 w-44 rounded-full border-4 border-green-400 object-cover shadow mb-3">
            </div>

            <div class="w-full flex-1">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-800">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="h-12 w-full rounded-xl border border-slate-300 bg-slate-50 px-4 text-sm outline-none transition focus:border-green-400 focus:bg-white"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-800">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="h-12 w-full rounded-xl border border-slate-300 bg-slate-50 px-4 text-sm outline-none transition focus:border-green-400 focus:bg-white"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-800">
                            Foto Profil
                        </label>
                        <input
                            type="file"
                            name="photo"
                            id="photo"
                            accept="image/*"
                            class="block w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm
                                   file:mr-4 file:rounded-lg file:border-0 file:bg-green-100 file:px-4 file:py-2
                                   file:text-sm file:font-medium file:text-green-700 hover:file:bg-green-200"
                        >
                    </div>

                    <div class="flex flex-col gap-3 pt-2 sm:flex-row">
                        <button
                            type="submit"
                            class="inline-flex h-12 flex-1 items-center justify-center rounded-full bg-green-500 px-6 text-sm font-semibold text-white transition hover:bg-green-600">
                            Simpan
                        </button>

                        <button type="button"
                            onclick="window.location.reload()"
                            class="inline-flex h-12 items-center justify-center rounded-full border border-slate-300 bg-slate-100 px-6 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="/home"
            class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>

            Kembali ke Beranda
        </a>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const photoInput = document.getElementById('photo');
    const previewImage = document.getElementById('preview-image');

    if (photoInput && previewImage) {
        photoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
            }
        });
    }
</script>
@endpush