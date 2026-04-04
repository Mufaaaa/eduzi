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
                Masukkan data anak untuk mengetahui status gizi berdasarkan Indeks Massa Tubuh (IMT).
            </p>
        </div>

        <!-- Card Form -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8" data-aos="fade-up" data-aos-delay="100">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">
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
                        <label for="jenis_kelamin" class="block text-sm font-semibold text-slate-700 mb-2">
                            Jenis Kelamin
                        </label>
                        <select
                            id="jenis_kelamin"
                            name="jenis_kelamin"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400"
                        >
                            <option value="">Pilih jenis kelamin</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Usia -->
                    <div>
                        <label for="usia" class="block text-sm font-semibold text-slate-700 mb-2">
                            Usia (bulan)
                        </label>
                        <input
                            type="number"
                            id="usia"
                            name="usia"
                            placeholder="Contoh: 12"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400"
                        >
                    </div>

                    <!-- Berat Badan -->
                    <div>
                        <label for="berat_badan" class="block text-sm font-semibold text-slate-700 mb-2">
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
                        <label for="tinggi_badan" class="block text-sm font-semibold text-slate-700 mb-2">
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

                    <!-- Upload Gambar -->
                    <div class="md:col-span-2">
                        <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-2">
                            Unggah Gambar Anak
                        </label>
                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            accept="image/*"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700
                                   file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-500 file:px-4 file:py-2
                                   file:text-white hover:file:bg-emerald-600 focus:outline-none focus:ring-2
                                   focus:ring-emerald-400 focus:border-emerald-400"
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

            <!-- Hasil Dummy -->
            <div class="mt-6 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-5">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400"></div>
                        <div>
                            <p class="text-xs text-slate-500">Hasil Perhitungan</p>
                            <h3 class="text-lg font-bold text-emerald-600">Gizi Baik (Normal)</h3>
                        </div>
                    </div>

                    <div class="text-left md:text-right">
                        <p class="text-xs text-slate-500">Indeks Massa Tubuh (IMT)</p>
                        <p class="text-2xl font-bold text-emerald-600">16,61</p>
                    </div>
                </div>

                <hr class="my-5 border-emerald-100">

                <div>
                    <h4 class="text-2xl font-bold mb-3 text-slate-900">
                        Penjelasan <span class="text-emerald-500">Status Gizi</span>
                    </h4>
                    <p class="text-sm leading-7 text-slate-700">
                        Gizi Baik (Normal) berarti asupan energi dan nutrisi anak saat ini telah mencukupi kebutuhan
                        untuk menunjang pertumbuhan fisik dan perkembangan motoriknya. Pada usia 12 bulan, anak berada
                        pada masa transisi dari ASI/MPASI ke makanan keluarga, sehingga menjaga konsistensi pola makan
                        sangat penting agar status gizi tetap stabil.
                    </p>
                </div>

                <hr class="my-5 border-emerald-100">

                <div>
                    <h4 class="text-2xl font-bold mb-3 text-slate-900">
                        <span class="text-emerald-500">Rekomendasi</span> Pemenuhan Gizi
                    </h4>

                    <p class="text-sm leading-7 text-slate-700 mb-2">
                        Agar status gizi tetap optimal dan mencegah risiko stunting atau gizi kurang di masa mendatang,
                        berikut langkah yang dapat dilakukan:
                    </p>

                    <ul class="list-disc pl-5 text-sm text-slate-700 leading-7 space-y-1">
                        <li><span class="font-semibold">Lanjutkan Makanan Keluarga:</span> Berikan makanan dengan tekstur yang sesuai dan rendah garam/gula.</li>
                        <li><span class="font-semibold">Prinsip Gizi Seimbang:</span> Pastikan makanan mengandung karbohidrat, protein hewani, sayur, dan buah.</li>
                        <li><span class="font-semibold">Prioritas Protein Hewani:</span> Berikan telur, ikan, ayam, atau daging merah secara bergantian.</li>
                        <li><span class="font-semibold">Jadwal Makan Teratur:</span> Terapkan 3 kali makan utama dan 2 kali camilan sehat.</li>
                        <li><span class="font-semibold">Pantau Rutin:</span> Lakukan penimbangan dan pengukuran tinggi badan secara berkala.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection