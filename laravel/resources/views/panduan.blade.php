@extends('layout.app')

@section('title', 'Panduan Gizi Seimbang untuk Anak')

@section('content')
<div class="min-h-screen bg-[#f6f8f5] py-12 px-4">

     @auth
            <x-navbar_home />
        @else
            <x-navbar_index />
        @endauth
        
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-14" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-sm font-medium border border-emerald-100">
                <i class="fa-solid fa-book-medical"></i>
                <span>Panduan Gizi</span>
            </div>

            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
                Panduan <span class="text-emerald-500">Gizi Seimbang</span> untuk Anak
            </h1>

            <p class="mt-4 text-gray-500 text-base md:text-lg leading-8 max-w-2xl mx-auto">
                Panduan lengkap kebutuhan gizi anak berdasarkan usia, jenis nutrisi, dan porsi harian yang direkomendasikan.
            </p>

            <div class="mt-10 flex justify-center">
                <div class="w-28 h-28 rounded-full bg-white shadow-sm border border-slate-200 flex items-center justify-center overflow-hidden">
                    <img
                        src="{{ asset('images/nutrition-guide.png') }}"
                        alt="Panduan Gizi"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>
        </div>

        <!-- Panduan Berdasarkan Usia -->
        <div class="mb-16">
            <div class="text-center mb-8" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
                    Panduan Berdasarkan <span class="text-emerald-500">Usia</span>
                </h2>
                <p class="mt-3 text-gray-500 text-base">
                    Kebutuhan gizi anak berbeda di setiap tahap pertumbuhan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                    </div>

                    <span class="inline-block text-[11px] font-medium px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 mb-4">
                        0–6 Bulan
                    </span>

                    <h3 class="text-lg font-bold text-slate-900 mb-2">ASI Eksklusif</h3>
                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Bayi hanya membutuhkan ASI selama 6 bulan pertama. ASI mengandung semua nutrisi yang dibutuhkan bayi.
                    </p>

                    <ul class="list-disc pl-5 text-sm text-slate-700 leading-7 space-y-1">
                        <li>ASI eksklusif tanpa tambahan apapun</li>
                        <li>Susui minimal 8–12 kali sehari</li>
                        <li>Pastikan posisi menyusui benar</li>
                    </ul>
                </div>

                <!-- Card 2 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                    </div>

                    <span class="inline-block text-[11px] font-medium px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 mb-4">
                        6–12 Bulan
                    </span>

                    <h3 class="text-lg font-bold text-slate-900 mb-2">MPASI Pertama</h3>
                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Mulai perkenalkan makanan pendamping ASI secara bertahap dengan tekstur yang sesuai.
                    </p>

                    <ul class="list-disc pl-5 text-sm text-slate-700 leading-7 space-y-1">
                        <li>Mulai dengan bubur halus saring</li>
                        <li>Kenalkan makanan baru setiap 3 hari sekali</li>
                        <li>Tetap berikan ASI sebagai makanan utama</li>
                    </ul>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>

                    <span class="inline-block text-[11px] font-medium px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 mb-4">
                        1–3 Tahun
                    </span>

                    <h3 class="text-lg font-bold text-slate-900 mb-2">Makanan Keluarga</h3>
                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Anak mulai bisa makan makanan keluarga dengan tekstur dan porsi yang disesuaikan.
                    </p>

                    <ul class="list-disc pl-5 text-sm text-slate-700 leading-7 space-y-1">
                        <li>Berikan 3 kali makanan utama + 2 kali selingan</li>
                        <li>Variasikan jenis makanan setiap hari</li>
                        <li>Hindari makanan tinggi gula dan garam</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Jenis Nutrisi Penting -->
        <div class="pb-8">
            <div class="text-center mb-8" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
                    Jenis <span class="text-emerald-500">Nutrisi</span> Penting
                </h2>
                <p class="mt-3 text-gray-500 text-base">
                    Kenali nutrisi esensial dan sumber makanannya untuk anak.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- Protein -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">
                            <i class="fa-regular fa-egg"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Protein</h3>
                            <p class="text-xs text-slate-400">2–3 porsi/hari</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Membangun dan memperbaiki jaringan dalam tubuh.
                    </p>

                    <div class="rounded-full bg-orange-100 text-orange-700 text-xs px-3 py-2">
                        Sumber: Telur, ikan, daging, tempe, tahu, dll.
                    </div>
                </div>

                <!-- Vitamin & Mineral -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">
                            <i class="fa-regular fa-lemon"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Vitamin & Mineral</h3>
                            <p class="text-xs text-slate-400">3–5 porsi/hari</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Menjaga daya tahan tubuh dan fungsi organ.
                    </p>

                    <div class="rounded-full bg-orange-100 text-orange-700 text-xs px-3 py-2">
                        Sumber: Sayuran hijau, wortel, brokoli, dll.
                    </div>
                </div>

                <!-- Karbohidrat -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">
                            <i class="fa-regular fa-bowl-rice"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Karbohidrat</h3>
                            <p class="text-xs text-slate-400">3–5 porsi/hari</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Sumber energi utama untuk aktivitas.
                    </p>

                    <div class="rounded-full bg-orange-100 text-orange-700 text-xs px-3 py-2">
                        Sumber: Nasi, roti, kentang, ubi, jagung, dll.
                    </div>
                </div>

                <!-- Serat -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="250">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">
                            <i class="fa-solid fa-seedling"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Serat</h3>
                            <p class="text-xs text-slate-400">2–3 porsi/hari</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Kaya serat dan vitamin untuk pencernaan.
                    </p>

                    <div class="rounded-full bg-orange-100 text-orange-700 text-xs px-3 py-2">
                        Sumber: Pisang, pepaya, jeruk, mangga, dll.
                    </div>
                </div>

                <!-- Kalsium -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">
                            <i class="fa-solid fa-glass-water"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Kalsium</h3>
                            <p class="text-xs text-slate-400">2–3 porsi/hari</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Menguatkan tulang dan gigi anak.
                    </p>

                    <div class="rounded-full bg-orange-100 text-orange-700 text-xs px-3 py-2">
                        Sumber: Susu, keju, yogurt, ikan teri, dll.
                    </div>
                </div>

                <!-- Air & Cairan -->
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="350">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">
                            <i class="fa-solid fa-droplet"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Air & Cairan</h3>
                            <p class="text-xs text-slate-400">6–8 gelas/hari</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 leading-7 mb-4">
                        Menjaga hidrasi dan metabolisme tubuh.
                    </p>

                    <div class="rounded-full bg-orange-100 text-orange-700 text-xs px-3 py-2">
                        Sumber: Air putih, kuah sayur, jus buah, dll.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer Index -->
    @include('components.footerindex')

@endsection