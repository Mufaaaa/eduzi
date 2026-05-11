 <section 
        onclick="window.location.href='/panduan'" 
        class="py-24 bg-[#f6f8f3] hover:bg-[#f1f5ef] transition cursor-pointer">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-10 items-center">
            <div class="flex justify-center">
                <img 
                    src="{{ asset('images/nutrition-guide.png') }}"
                    alt="Panduan Gizi Seimbang"
                    class="w-full max-w-md object-contain"
                >
            </div>

            <div>
                <h3 class="text-4xl font-bold text-[#1f3b2f] leading-tight">
                    Panduan Gizi <span class="text-[#49a35a]">Seimbang</span>
                </h3>

                <p class="mt-5 text-[#7a8b80] max-w-xl leading-relaxed">
                    Pastikan anak Anda mendapatkan asupan gizi seimbang setiap hari dengan panduan
                    porsi yang tepat sesuai usia.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                    <div class="bg-white border border-[#e5ebe2] rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                        <div class="text-[#49a35a] text-3xl mb-3">🥬</div>
                        <h4 class="font-semibold text-[#1f3b2f]">Sayuran</h4>
                        <p class="text-sm text-[#7a8b80] mt-1">3–5 porsi/hari</p>
                    </div>

                    <div class="bg-white border border-[#e5ebe2] rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                        <div class="text-[#49a35a] text-3xl mb-3">🍎</div>
                        <h4 class="font-semibold text-[#1f3b2f]">Buah</h4>
                        <p class="text-sm text-[#7a8b80] mt-1">2–3 porsi/hari</p>
                    </div>

                    <div class="bg-white border border-[#e5ebe2] rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">
                        <div class="text-[#49a35a] text-3xl mb-3">🥚</div>
                        <h4 class="font-semibold text-[#1f3b2f]">Protein</h4>
                        <p class="text-sm text-[#7a8b80] mt-1">2–3 porsi/hari</p>
                    </div>
                </div>

                <div class="mt-8">
                    <span class="inline-flex items-center text-[#49a35a] font-semibold">
                        Lihat panduan lengkap
                        <span class="ml-2">→</span>
                    </span>
                </div>
            </div>
        </div>
</section>