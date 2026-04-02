@extends('layout.app')

@section('title', 'Beranda')

@section('content')
<div class="bg-[#f6f8f3] text-[#1f3b2f]">

    <!-- Navbar Index -->
    @include('components.navbar_index')

    <!-- Hero -->
    <section class="py-14 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-14 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-[#e8f4ea] text-[#4f8d60] px-4 py-2 rounded-full text-sm font-medium mb-6">
                    <span>🛡️</span>
                    <span>Sumber Gizi Terpercaya</span>
                </div>

                <h2 class="text-5xl lg:text-6xl font-bold leading-tight text-[#1f3b2f]">
                    Wujudkan Generasi
                    <span class="text-[#43a047]">Sehat</span> &
                    <span class="text-[#f0a23a]">Bebas</span>
                    <span class="text-[#f0a23a] block">Stunting</span>
                </h2>

                <p class="mt-6 text-[#708277] text-lg leading-relaxed max-w-xl">
                    Eduzi membantu Anda memahami gizi seimbang untuk anak dengan informasi akurat,
                    mudah dipahami, dan fitur interaktif.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#" class="bg-[#49a35a] hover:bg-[#3f8e4e] text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-sm">
                        <i class="fas fa-notes-medical mr-2"></i>Cek Gizi Anak
                    </a>
                    <a href="/artikel" class="bg-white border border-[#dfe6dc] hover:bg-[#f2f5ef] text-[#334d40] px-6 py-3 rounded-xl text-sm font-semibold transition">
                        <i class="far fa-newspaper mr-2"></i>Baca Artikel
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="bg-[#e9e9cf] rounded-[30px] p-5 shadow-sm">
                    <div class="rounded-3xl overflow-hidden">
                        <img
                            src="{{ asset('images/hero-image.jpg') }}"
                            alt="Hero Eduzi"
                            class="w-full h-96 object-cover"
                        >
                    </div>
                </div>              
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="py-20 bg-[#f2f5f0]">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="text-center mb-14">
                <h3 class="text-4xl font-bold text-[#1f3b2f]">Fitur Utama</h3>
                <p class="mt-3 text-[#7a8b80] max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk memastikan gizi terbaik bagi si kecil
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white border border-[#e5ebe2] rounded-2xl p-7 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-[#49a35a] text-white flex items-center justify-center text-lg mb-5">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <h4 class="text-2xl font-semibold text-[#1f3b2f] mb-3">Artikel Edukasi</h4>
                    <p class="text-[#7a8b80] leading-relaxed mb-5">
                        Artikel dan video tentang gizi anak yang ditulis oleh ahli gizi berpengalaman.
                    </p>
                    <a href="#" class="text-[#49a35a] font-semibold text-sm">Pelajari lebih lanjut →</a>
                </div>

                <div class="bg-white border border-[#e5ebe2] rounded-2xl p-7 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-[#49a35a] text-white flex items-center justify-center text-lg mb-5">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h4 class="text-2xl font-semibold text-[#1f3b2f] mb-3">Kalkulator Gizi</h4>
                    <p class="text-[#7a8b80] leading-relaxed mb-5">
                        Pantau status gizi anak dengan kalkulator berbasis standar WHO.
                    </p>
                    <a href="#" class="text-[#49a35a] font-semibold text-sm">Pelajari lebih lanjut →</a>
                </div>

                <div class="bg-white border border-[#e5ebe2] rounded-2xl p-7 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-[#49a35a] text-white flex items-center justify-center text-lg mb-5">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="text-2xl font-semibold text-[#1f3b2f] mb-3">Forum Komunitas</h4>
                    <p class="text-[#7a8b80] leading-relaxed mb-5">
                        Diskusi dan berbagi pengalaman dengan sesama orang tua dan ahli gizi.
                    </p>
                    <a href="#" class="text-[#49a35a] font-semibold text-sm">Pelajari lebih lanjut →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel -->
    <section class="py-20 bg-[#eef2ed]">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
                <div>
                    <h3 class="text-4xl font-bold text-[#1f3b2f]">Artikel Terbaru</h3>
                    <p class="mt-2 text-[#7a8b80]">Informasi gizi terkini untuk keluarga Anda</p>
                </div>

                <a href="#" class="self-start md:self-auto bg-white border border-[#dfe6dc] px-5 py-2.5 rounded-full text-sm font-medium text-[#334d40] hover:bg-[#f7f9f6] transition">
                    Semua Artikel <span class="ml-1">→</span>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl border border-[#e4e9e2] overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="h-28 bg-[#dce9df] flex items-center justify-center text-5xl text-[#a9b4ad]">
                        ☆
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-[#eef8ef] text-[#49a35a] px-3 py-1 rounded-full text-xs font-semibold mb-4">
                            ASI & Menyusui
                        </span>
                        <h4 class="text-xl font-semibold text-[#1f3b2f] leading-snug mb-3">
                            Pentingnya ASI Eksklusif untuk 6 Bulan Pertama
                        </h4>
                        <p class="text-[#7a8b80] leading-relaxed text-sm">
                            ASI eksklusif memberikan nutrisi lengkap yang dibutuhkan bayi dan melindungi dari berbagai penyakit.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-[#e4e9e2] overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="h-28 bg-[#e5efe2] flex items-center justify-center text-5xl text-[#a9b4ad]">
                        ↗
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-[#eef8ef] text-[#49a35a] px-3 py-1 rounded-full text-xs font-semibold mb-4">
                            Stunting
                        </span>
                        <h4 class="text-xl font-semibold text-[#1f3b2f] leading-snug mb-3">
                            Mengenal Tanda-Tanda Stunting pada Anak
                        </h4>
                        <p class="text-[#7a8b80] leading-relaxed text-sm">
                            Deteksi dini stunting sangat penting untuk mencegah dampak jangka panjang pada pertumbuhan anak.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-[#e4e9e2] overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="h-28 bg-[#f2ece7] flex items-center justify-center text-5xl text-[#a9b4ad]">
                        
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-[#eef8ef] text-[#49a35a] px-3 py-1 rounded-full text-xs font-semibold mb-4">
                            MPASI
                        </span>
                        <h4 class="text-xl font-semibold text-[#1f3b2f] leading-snug mb-3">
                            Panduan MPASI untuk Bayi 6-12 Bulan
                        </h4>
                        <p class="text-[#7a8b80] leading-relaxed text-sm">
                            Tips mempersiapkan makanan pendamping ASI yang bergizi dan aman untuk si kecil.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Panduan -->
    <section class="py-24 bg-[#f6f8f3]">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-10 items-center">
            
            <!-- Image -->
            <div class="flex justify-center">
                <img 
                    src="{{ asset('images/nutrition-guide.png') }}"
                    alt="Panduan Gizi Seimbang"
                    class="w-full max-w-md object-contain"
                >
            </div>

            <!-- Text -->
            <div>
                <h3 class="text-4xl font-bold text-[#1f3b2f] leading-tight">
                    Panduan Gizi <span class="text-[#49a35a]">Seimbang</span>
                </h3>

                <p class="mt-5 text-[#7a8b80] max-w-xl leading-relaxed">
                    Pastikan anak Anda mendapatkan asupan gizi seimbang setiap hari dengan panduan
                    porsi yang tepat sesuai usia.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                    <div class="bg-white border border-[#e5ebe2] rounded-2xl p-6 text-center shadow-sm">
                        <div class="text-[#49a35a] text-3xl mb-3">🥬</div>
                        <h4 class="font-semibold text-[#1f3b2f]">Sayuran</h4>
                        <p class="text-sm text-[#7a8b80] mt-1">3–5 porsi/hari</p>
                    </div>

                    <div class="bg-white border border-[#e5ebe2] rounded-2xl p-6 text-center shadow-sm">
                        <div class="text-[#49a35a] text-3xl mb-3">🍎</div>
                        <h4 class="font-semibold text-[#1f3b2f]">Buah</h4>
                        <p class="text-sm text-[#7a8b80] mt-1">2–3 porsi/hari</p>
                    </div>

                    <div class="bg-white border border-[#e5ebe2] rounded-2xl p-6 text-center shadow-sm">
                        <div class="text-[#49a35a] text-3xl mb-3">🥚</div>
                        <h4 class="font-semibold text-[#1f3b2f]">Protein</h4>
                        <p class="text-sm text-[#7a8b80] mt-1">2–3 porsi/hari</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="bg-[#49a35a] rounded-3xl px-6 md:px-12 py-14 text-center text-white shadow-sm">
                <h3 class="text-4xl font-bold mb-4">Mulai Pantau Gizi Anak Anda Sekarang</h3>
                <p class="max-w-2xl mx-auto text-[#e8f6eb] leading-relaxed mb-8">
                    Gunakan kalkulator gizi kami untuk mengetahui status gizi anak berdasarkan standar WHO.
                </p>
                <a href="#" class="inline-block bg-[#ef9640] hover:bg-[#e4862f] text-white px-8 py-3 rounded-xl font-semibold transition">
                    <i class="far fa-clipboard mr-2"></i>Cek Gizi Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Index -->
    @include('components.footerindex')

</div>
@endsection