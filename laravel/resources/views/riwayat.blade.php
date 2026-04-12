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
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8" data-aos="fade-up" data-aos-delay="100">

            <span class="block text-xl font-semibold text-black-600">Riwayat Kalkulator Gizi</span>

            <!-- Hasil Dummy -->
            <span class="mt-6 block text-md text-slate-500">16 Maret 2026</span>
            <div class="mt-3 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-5">
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

            <span class="mt-6 block text-md text-slate-500">27 Maret 2026</span>
            <div class="mt-3 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-5">
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
            </div>

        </div>
    </div>
</div>
@endsection