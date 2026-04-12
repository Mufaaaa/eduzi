@extends('layout.app')

@section('title', 'Informasi Gizi Terpercaya')

@section('content')
<div class="min-h-screen bg-[#f7f9f7] py-12 px-4">

    @auth
        <x-navbar_home />
    @else
        <x-navbar_index />
    @endauth

    <div class="max-w-6xl mx-auto mt-8">
        <div class="text-center mb-10" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-sm font-medium border border-emerald-100 mb-4">
                <i class="fa-solid fa-book-open"></i>
                <span>Artikel Edukasi</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Informasi <span class="text-emerald-500">Gizi</span> Terpercaya
            </h1>

            <p class="mt-4 text-gray-500 text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                Artikel informatif seputar gizi anak, kehamilan, dan pola makan sehat untuk keluarga.
            </p>
        </div>

        <div class="max-w-2xl mx-auto mb-8" data-aos="fade-up" data-aos-delay="100">
            <input 
                type="text" 
                placeholder="Cari artikel atau video . . ." 
                class="w-full rounded-2xl border border-slate-200 px-6 py-4 text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm"
            >
        </div>

        <div class="flex justify-center gap-4 mb-10" data-aos="fade-up" data-aos-delay="150">
            <button id="btn-artikel" onclick="switchTab('artikel')" class="px-10 py-3 rounded-xl font-bold text-white bg-emerald-500 shadow-md transition-all duration-200 w-36 text-center">
                Artikel
            </button>
            <button id="btn-video" onclick="switchTab('video')" class="px-10 py-3 rounded-xl font-bold text-emerald-600 bg-white border-2 border-emerald-500 shadow-sm hover:bg-emerald-50 transition-all duration-200 w-36 text-center">
                Video
            </button>
        </div>

        <div id="tab-artikel" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="200">
            
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 flex flex-col">
                <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ibu dan anak" class="w-full h-52 object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <span class="w-fit px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold mb-3 border border-emerald-100">Asi & Menyusui</span>
                    <h3 class="font-bold text-lg text-slate-900 mb-2 leading-snug">Pentingnya ASI Eksklusif pada 6 Bulan Pertama</h3>
                    <p class="text-sm text-gray-500 line-clamp-3">ASI Eksklusif memberikan nutrisi lengkap yang dibutuhkan bayi untuk tumbuh kembang optimal selama 6 bulan pertama kehidupan.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 flex flex-col">
                <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Stunting anak" class="w-full h-52 object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <span class="w-fit px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold mb-3 border border-emerald-100">Stunting</span>
                    <h3 class="font-bold text-lg text-slate-900 mb-2 leading-snug">Mengenal Tanda-Tanda Stunting pada Anak</h3>
                    <p class="text-sm text-gray-500 line-clamp-3">Stunting adalah kondisi gagal tumbuh pada anak akibat kekurangan gizi kronis. Kenali tanda-tandanya sejak dini.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 flex flex-col">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="MPASI" class="w-full h-52 object-cover">
                <div class="p-6 flex-1 flex flex-col">
                    <span class="w-fit px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold mb-3 border border-emerald-100">MPASI</span>
                    <h3 class="font-bold text-lg text-slate-900 mb-2 leading-snug">Panduan MPASI untuk Bayi 6-12 Bulan</h3>
                    <p class="text-sm text-gray-500 line-clamp-3">Tips dan resep MPASI yang bergizi, aman, dan sesuai dengan tahapan perkembangan bayi Anda.</p>
                </div>
            </div>

        </div>

        <div id="tab-video" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 hidden">
            
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 cursor-pointer group">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Video Thumb" class="w-full h-52 object-cover group-hover:opacity-90 transition">
                    <span class="absolute bottom-3 right-3 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded">7:25</span>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="bg-white/80 rounded-full w-12 h-12 flex items-center justify-center">
                            <i class="fa-solid fa-play text-emerald-500 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-md text-slate-900 leading-snug">Kenapa bayi harus ASI? Pentingnya ASI Eksklusif pada 6 Bulan Pertama</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 cursor-pointer group">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Video Thumb" class="w-full h-52 object-cover group-hover:opacity-90 transition">
                    <span class="absolute bottom-3 right-3 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded">5:14</span>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="bg-white/80 rounded-full w-12 h-12 flex items-center justify-center">
                            <i class="fa-solid fa-play text-emerald-500 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-md text-slate-900 leading-snug">ANAK PENDEK STUNTING?? Mengenal Tanda-Tanda Stunting pada Anak</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 cursor-pointer group">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Video Thumb" class="w-full h-52 object-cover group-hover:opacity-90 transition">
                    <span class="absolute bottom-3 right-3 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded">8:42</span>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <div class="bg-white/80 rounded-full w-12 h-12 flex items-center justify-center">
                            <i class="fa-solid fa-play text-emerald-500 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-md text-slate-900 leading-snug">Anak Mogok Makan Bun? Yuk Intip Panduan MPASI untuk Bayi 6-12 Bulan</h3>
                </div>
            </div>

        </div>

        <div class="mt-16 bg-linear-to-br from-emerald-500 to-[#3aa26d] rounded-3xl p-8 md:p-12 text-center text-white shadow-lg relative overflow-hidden" data-aos="zoom-in">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="relative z-10">
                <h2 class="text-2xl md:text-4xl font-bold mb-4">Mulai Pantau Gizi Anak Anda Sekarang</h2>
                <p class="mb-8 text-emerald-50 text-base md:text-lg">Gunakan kalkulator gizi kami untuk mengetahui status gizi anak berdasarkan standar WHO.</p>
                <a href="#" class="inline-flex items-center gap-2 bg-[#ff7b5c] hover:bg-[#e0674b] text-white font-bold py-3.5 px-8 rounded-xl transition duration-200 shadow-md">
                    <i class="fa-solid fa-calculator"></i>
                    Cek Gizi Sekarang
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    function switchTab(tab) {
        const btnArtikel = document.getElementById('btn-artikel');
        const btnVideo = document.getElementById('btn-video');
        const tabArtikel = document.getElementById('tab-artikel');
        const tabVideo = document.getElementById('tab-video');

        // Class untuk button aktif (Hijau solid)
        const activeClasses = "px-10 py-3 rounded-xl font-bold text-white bg-emerald-500 shadow-md transition-all duration-200 w-36 text-center border-2 border-emerald-500";
        // Class untuk button tidak aktif (Putih border hijau)
        const inactiveClasses = "px-10 py-3 rounded-xl font-bold text-emerald-600 bg-white border-2 border-emerald-500 shadow-sm hover:bg-emerald-50 transition-all duration-200 w-36 text-center";

        if (tab === 'artikel') {
            btnArtikel.className = activeClasses;
            btnVideo.className = inactiveClasses;
            tabArtikel.classList.remove('hidden');
            tabVideo.classList.add('hidden');
        } else {
            btnVideo.className = activeClasses;
            btnArtikel.className = inactiveClasses;
            tabVideo.classList.remove('hidden');
            tabArtikel.classList.add('hidden');
        }
    }
</script>
@endsection