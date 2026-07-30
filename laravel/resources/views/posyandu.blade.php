@extends('layout.app')

@section('title', 'Jadwal Posyandu')

@section('content')
<div class="min-h-screen bg-[#F8FAF5] py-10">

    @auth
        <x-navbar_home />
    @else
        <x-navbar_index />
    @endauth

    <div class="max-w-5xl mx-auto px-4">

        {{-- Header --}}
        <div class="text-center mb-10">

            <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 text-xs font-semibold px-4 py-2 rounded-full">
                📅 Jadwal Posyandu
            </span>

            <h1 class="text-4xl font-bold text-gray-800 mt-4">
                Jadwal Posyandu Bulanan
            </h1>

            <p class="text-gray-500 mt-3">
                Pemeriksaan Posyandu diadakan pada tanggal 21 setiap bulannya.
                <br>
                Catat jadwalnya dan bawa anak untuk pemantauan gizi.
            </p>

        </div>

        {{-- Card Utama --}}
        <div class="bg-white rounded-2xl shadow border overflow-hidden">

            <div class="h-2 bg-green-600"></div>

            <div class="p-8">

                <div class="flex justify-between items-start">

                    <div>

                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                            HARI INI
                        </span>

                        <h2 class="text-3xl font-bold mt-5 text-gray-800">
                            Selasa, 21 Juli 2026
                        </h2>

                        <div class="mt-6 space-y-2 text-gray-600">

                            <div class="flex items-center gap-2">
                                📍 Posyandu Melati
                            </div>

                            <div class="flex items-center gap-2">
                                🕘 08.00 WIB
                            </div>

                        </div>

                    </div>

                    {{-- Kotak tanggal --}}
                    <div class="w-24 rounded-xl overflow-hidden shadow">

                        <div class="bg-green-500 text-white py-4 text-center">

                            <div class="text-4xl font-bold">
                                21
                            </div>

                            <div class="uppercase text-sm">
                                JUL
                            </div>

                        </div>

                        <div class="bg-orange-400 text-white text-center text-xs py-1">
                            2026
                        </div>

                    </div>

                </div>

                <hr class="my-8">

                <div class="grid md:grid-cols-2 gap-8">

                    <div>

                        <h3 class="font-semibold mb-4 text-gray-700">
                            Yang Harus Dipersiapkan
                        </h3>

                        <ul class="space-y-3 text-gray-600">

                            <li>✔ Buku KIA / KMS</li>

                            <li>✔ Pastikan anak sudah sarapan</li>

                            <li>✔ Gunakan pakaian yang nyaman</li>

                            <li>✔ Datang bersama orang tua</li>

                        </ul>

                    </div>

                    <div>

                        <h3 class="font-semibold mb-4 text-gray-700">
                            Pemeriksaan
                        </h3>

                        <ul class="space-y-3 text-gray-600">

                            <li>✔ Penimbangan berat badan</li>

                            <li>✔ Pengukuran tinggi badan</li>

                            <li>✔ Konsultasi gizi</li>

                            <li>✔ Imunisasi (sesuai jadwal)</li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

        {{-- Jadwal Mendatang --}}
        <div class="mt-10">

            <h2 class="text-xl font-bold text-gray-800 mb-5">
                Jadwal Mendatang
            </h2>

            <div class="grid md:grid-cols-3 gap-5">

                {{-- Card --}}
                <div class="bg-white rounded-xl shadow border p-4 flex gap-4 items-center">

                    <div class="w-16 rounded-lg overflow-hidden">

                        <div class="bg-green-500 text-white text-center py-2">

                            <div class="text-2xl font-bold">21</div>

                            <div class="text-xs uppercase">AGU</div>

                        </div>

                    </div>

                    <div>

                        <p class="font-semibold">
                            Kamis
                        </p>

                        <p class="text-sm text-gray-500">
                            21 Agustus 2026
                        </p>

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow border p-4 flex gap-4 items-center">

                    <div class="w-16 rounded-lg overflow-hidden">

                        <div class="bg-green-500 text-white text-center py-2">

                            <div class="text-2xl font-bold">21</div>

                            <div class="text-xs uppercase">SEP</div>

                        </div>

                    </div>

                    <div>

                        <p class="font-semibold">
                            Senin
                        </p>

                        <p class="text-sm text-gray-500">
                            21 September 2026
                        </p>

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow border p-4 flex gap-4 items-center">

                    <div class="w-16 rounded-lg overflow-hidden">

                        <div class="bg-green-500 text-white text-center py-2">

                            <div class="text-2xl font-bold">21</div>

                            <div class="text-xs uppercase">OKT</div>

                        </div>

                    </div>

                    <div>

                        <p class="font-semibold">
                            Rabu
                        </p>

                        <p class="text-sm text-gray-500">
                            21 Oktober 2026
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@include('components.footerindex')
@endsection