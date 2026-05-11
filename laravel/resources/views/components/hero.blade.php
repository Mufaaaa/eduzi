<section class="py-14 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-14 items-center">
            <div>

                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-[#e8f4ea] text-[#4f8d60] px-4 py-2 rounded-full text-sm font-medium mb-6">
                    <span>👋</span>
                    <span>Selamat Datang Kembali</span>
                </div>

                <!-- Heading -->
                <h2 class="text-5xl lg:text-6xl font-bold leading-tight text-[#1f3b2f]">
                    Halo, <span class="text-[#43a047]">{{ Auth::user()->name }}</span> 👋
                </h2>

                <!-- Deskripsi -->
                <p class="mt-6 text-[#708277] text-lg leading-relaxed max-w-xl">
                    Senang bertemu Anda lagi. Yuk, pantau perkembangan gizi si kecil
                    dan temukan artikel terbaru hari ini untuk mendukung tumbuh
                    kembang anak yang sehat.
                </p>

                <!-- Button -->
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#" class="bg-[#49a35a] hover:bg-[#3f8e4e] text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-sm">
                        <i class="fas fa-notes-medical mr-2"></i>Pantau Gizi Anak
                    </a>

                    <a href="/artikel" class="bg-white border border-[#dfe6dc] hover:bg-[#f2f5ef] text-[#334d40] px-6 py-3 rounded-xl text-sm font-semibold transition">
                        <i class="far fa-newspaper mr-2"></i>Baca Artikel
                    </a>
                </div>

            </div>

            <!-- Image -->
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