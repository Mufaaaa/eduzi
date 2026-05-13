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
                <span>Riwayat</span>
            </div>

            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Lihat <span class="text-emerald-500">Riwayat</span> Gizi Anak
            </h1>

            <p class="mt-4 text-gray-500 text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                Anda dapat melihat riwayat penggunaan kalkulator gizi disini.
            </p>

        </div>

        <!-- Card Background -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8"
             data-aos="fade-up"
             data-aos-delay="100">

            <span class="block text-xl font-semibold text-black-600">
                Riwayat Kalkulator Gizi
            </span>

            @foreach ($riwayat as $item)

            <!-- TANGGAL -->
            <span class="mt-6 block text-md text-slate-500">
                {{ $item->created_at->format('d F Y') }}
            </span>

            <!-- CARD -->
            <div class="mt-3 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-5">

                <!-- DATA ANAK -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                    <!-- NAMA -->
                    <div class="md:col-span-2 bg-white rounded-xl p-4 border border-emerald-100">

                        <p class="text-xs text-slate-500">
                            Nama Anak
                        </p>

                        <p class="font-semibold text-slate-800 text-lg">
                            {{ $item->dataAnak->nama_anak }}
                        </p>

                    </div>

                    <!-- JENIS KELAMIN -->
                    <div class="bg-white rounded-xl p-4 border border-emerald-100">

                        <p class="text-xs text-slate-500">
                            Jenis Kelamin
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $item->dataAnak->jenis_kelamin }}
                        </p>

                    </div>

                    <!-- UMUR -->
                    <div class="bg-white rounded-xl p-4 border border-emerald-100">

                        <p class="text-xs text-slate-500">
                            Umur
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $item->dataAnak->umur_bulan }} Bulan
                        </p>

                    </div>

                    <!-- TINGGI BADAN -->
                    <div class="bg-white rounded-xl p-4 border border-emerald-100">

                        <p class="text-xs text-slate-500">
                            Tinggi Badan
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $item->dataAnak->tinggi_badan }} cm
                        </p>

                    </div>

                    <!-- BERAT BADAN -->
                    <div class="bg-white rounded-xl p-4 border border-emerald-100">

                        <p class="text-xs text-slate-500">
                            Berat Badan
                        </p>

                        <p class="font-semibold text-slate-800">
                            {{ $item->dataAnak->berat_badan }} kg
                        </p>

                    </div>

                </div>

                <!-- HASIL + BMI -->
                <div class="flex items-center justify-between gap-4">

                    <!-- KIRI -->
                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400"></div>

                        <div>

                            <p class="text-xs text-slate-500">
                                Hasil Perhitungan
                            </p>

                            <h3 class="text-2xl font-bold text-emerald-600">
                                {{ $item->hasil_prediksi }}
                            </h3>

                        </div>

                    </div>

                    <!-- KANAN BMI -->
                    <div class="text-right">

                        <p class="text-xs text-slate-500">
                            BMI Anak
                        </p>

                        <h3 class="text-2xl font-bold text-emerald-600">
                            {{ $item->bmi }}
                        </h3>

                    </div>

                </div>

                <hr class="my-5 border-emerald-100">

                <!-- PENJELASAN -->
                <div>

                    <h4 class="text-2xl font-bold mb-3 text-slate-900">

                        Penjelasan
                        <span class="text-emerald-500">
                            Status Gizi
                        </span>

                    </h4>

                    <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">
                        {{ $item->penjelasan }}
                    </p>

                </div>

                <hr class="my-5 border-emerald-100">

                <!-- REKOMENDASI -->
                <div>

                    <h4 class="text-2xl font-bold mb-3 text-slate-900">

                        <span class="text-emerald-500">
                            Rekomendasi
                        </span>

                        Pemenuhan Gizi

                    </h4>

                    <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">
                        {!! nl2br(e($item->rekomendasi)) !!}
                    </p>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>
@endsection