@extends('layout.app')

@section('title', 'Pantau Status Gizi Anak')

@section('content')
<div class="min-h-screen bg-[#f7f9f7] py-12 px-4">

    @auth
        <x-navbar_home />
    @else
        <x-navbar_index />
    @endauth

    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-10" data-aos="fade-up">

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-sm font-medium border border-emerald-100">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Kalkulator Gizi Anak</span>
            </div>

            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Pantau <span class="text-emerald-500">Status Gizi</span> Anak
            </h1>

            <p class="mt-4 text-gray-500 text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                Masukkan data anak untuk mengetahui status gizi berdasarkan AI.
            </p>

        </div>

        <!-- Card Form -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8"
             data-aos="fade-up"
             data-aos-delay="100">

            <form action="{{ url('/predict') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Nama -->
                    <div class="md:col-span-2">

                        <label for="nama"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Nama Anak

                        </label>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            placeholder="Masukkan nama anak"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400"
                        >

                    </div>

                    <!-- Jenis Kelamin -->
                    <div>

                        <label for="jenis_kelamin"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Jenis Kelamin

                        </label>

                        <select
                            id="jenis_kelamin"
                            name="jenis_kelamin"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400"
                        >

                            <option value="">
                                Pilih jenis kelamin
                            </option>

                            <option value="Laki-laki">
                                Laki-laki
                            </option>

                            <option value="Perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>

                    <!-- Umur -->
                    <div>

                        <label for="umur_bulan"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Usia (bulan)

                        </label>

                        <input
                            type="number"
                            id="umur_bulan"
                            name="umur_bulan"
                            placeholder="Contoh: 12"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400"
                        >

                    </div>

                    <!-- Berat Badan -->
                    <div>

                        <label for="berat_badan"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Berat Badan (kg)

                        </label>

                        <input
                            type="number"
                            step="0.1"
                            id="berat_badan"
                            name="berat_badan"
                            placeholder="Contoh: 12"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400"
                        >

                    </div>

                    <!-- Tinggi Badan -->
                    <div>

                        <label for="tinggi_badan"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Tinggi Badan (cm)

                        </label>

                        <input
                            type="number"
                            step="0.1"
                            id="tinggi_badan"
                            name="tinggi_badan"
                            placeholder="Contoh: 85"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400"
                        >

                    </div>

                </div>

                <!-- Tombol -->
                <div class="flex flex-col sm:flex-row gap-3 mt-6">

                    <button
                        type="submit"
                        class="flex-1 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-3 transition duration-200 shadow-sm"
                    >

                        <i class="fa-solid fa-check mr-2"></i>
                        Hitung Status Gizi

                    </button>

                    <button
                        type="reset"
                        class="sm:w-32 rounded-xl border border-slate-300 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium px-5 py-3 transition duration-200"
                    >

                        Reset

                    </button>

                </div>

            </form>

            <!-- ERROR -->
            @if(isset($hasil['error']))

                <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-5">

                    <h3 class="text-red-600 font-bold mb-2">
                        Terjadi Error
                    </h3>

                    <p class="text-sm text-red-500">
                        {{ $hasil['error'] }}
                    </p>

                </div>

            @endif

            <!-- HASIL -->
        @if(isset($hasil) && !isset($hasil['error']))

        <div class="mt-8 rounded-3xl border border-emerald-100 bg-emerald-50/60 p-6 md:p-8">

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

                <div class="flex items-start gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-400"></div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Hasil Prediksi
                        </p>

                        <h2 class="text-3xl font-bold text-emerald-600">
                            {{ $hasil['prediction'] }}
                        </h2>

                    </div>

                </div>

            </div>

            <hr class="my-6 border-emerald-100">

            <!-- PENJELASAN -->
            <div>

                <h3 class="text-3xl font-bold text-slate-900 mb-4">

                    Penjelasan
                    <span class="text-emerald-500">
                        Status Gizi
                    </span>

                </h3>

                <p class="text-lg leading-9 text-slate-700 whitespace-pre-line">
                    {{ $hasil['penjelasan'] }}
                </p>

            </div>

            <hr class="my-6 border-emerald-100">

            <!-- REKOMENDASI -->
            <div>

                <h3 class="text-3xl font-bold text-slate-900 mb-4">

                    Rekomendasi
                    <span class="text-emerald-500">
                        Pemenuhan Gizi
                    </span>

                </h3>

                <div class="text-lg leading-9 text-slate-700 whitespace-pre-line">
                    {!! nl2br(e($hasil['rekomendasi'])) !!}
                </div>

            </div>

            <!-- DISCLAIMER -->
            <div class="mt-5 rounded-2xl border border-red-200 bg-red-50 p-4">

                <p class="text-sm leading-7 text-red-500">

                    <span class="font-bold">
                        Disclaimer:
                    </span>

                    Hasil ini hanya berupa prediksi AI dan bukan diagnosis medis resmi.
                    Untuk hasil yang lebih akurat, silakan konsultasikan dengan dokter
                    atau ahli gizi anak.

                </p>

            </div>

        </div>

        @endif

        </div>
    </div>
</div>
@endsection