<section class="py-20 bg-[#eef2ed]">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
                <div>
                    <h3 class="text-4xl font-bold text-[#1f3b2f]">Artikel Terbaru</h3>
                    <p class="mt-2 text-[#7a8b80]">
                        Informasi gizi terkini untuk keluarga Anda
                    </p>
                </div>

                <a href="{{ route('artikelvideo') }}"
                class="self-start md:self-auto bg-white border border-[#dfe6dc] px-5 py-2.5 rounded-full text-sm font-medium text-[#334d40] hover:bg-[#f7f9f6] transition">
                    Semua Artikel <span class="ml-1">→</span>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($artikels as $artikel)
                    <div class="bg-white rounded-2xl border border-[#e4e9e2] overflow-hidden shadow-sm hover:shadow-md transition">

                        {{-- Gambar --}}
                        <img src="{{ asset('storage/' . $artikel->gambar) }}"
                            alt="{{ $artikel->judul }}"
                            class="w-full h-52 object-cover">

                        <div class="p-6">

                            {{-- Kategori --}}
                            <span class="inline-block bg-[#eef8ef] text-[#49a35a] px-3 py-1 rounded-full text-xs font-semibold mb-4">
                                {{ $artikel->kategori }}
                            </span>

                            {{-- Judul --}}
                            <h4 class="text-xl font-semibold text-[#1f3b2f] leading-snug mb-3">
                                {{ $artikel->judul }}
                            </h4>

                            {{-- Isi Singkat --}}
                            <p class="text-[#7a8b80] leading-relaxed text-sm">
                                {{ Str::limit(strip_tags($artikel->isi), 100) }}
                            </p>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
</section>