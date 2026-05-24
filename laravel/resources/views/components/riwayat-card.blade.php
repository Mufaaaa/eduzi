@props(['item'])

<!-- TANGGAL -->
<span class="mt-6 block text-md text-slate-500">
    {{ $item->created_at->format('d F Y') }}
</span>

<!-- CARD ACCORDION (Menggunakan tag <details>) -->
<details class="group mt-3 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-5 transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
    
    <!-- 1. BAGIAN YANG SELALU TERLIHAT (HEADER CARD) -->
    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none select-none">
        
        <!-- Sisi Kiri: Hasil & Status Gizi -->
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400 flex items-center justify-center text-white">
                <i class="fa-solid fa-heart-pulse text-lg"></i>
            </div>
            <div>
                <p class="text-xs text-slate-500">Hasil Perhitungan / Status</p>
                <h3 class="text-xl md:text-2xl font-bold text-emerald-600">
                    {{ $item->hasil_prediksi }}
                </h3>
            </div>
        </div>

        <!-- Sisi Kanan: BMI & Arrow Icon -->
        <div class="flex items-center gap-6">
            <div class="text-right">
                <p class="text-xs text-slate-500">BMI Anak</p>
                <h3 class="text-xl md:text-2xl font-bold text-emerald-600">{{ $item->bmi }}</h3>
            </div>
            
            <!-- Arrow yang berputar otomatis 180 derajat saat accordion terbuka -->
            <div class="text-slate-400 group-open:text-emerald-500 transition-transform duration-300 group-open:rotate-180">
                <i class="fa-solid fa-chevron-down text-lg"></i>
            </div>
        </div>

    </summary>

    <!-- 2. BAGIAN DETAIL (OTOMATIS MUNCUL KE BAWAH SAAT DIKLIK) -->
    <div class="mt-5 border-t border-emerald-100 pt-5 space-y-6 animate-fade-in">
        
        <!-- DATA ANAK -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nama Anak -->
            <div class="md:col-span-2 bg-white rounded-xl p-4 border border-emerald-100">
                <p class="text-xs text-slate-500">Nama Anak</p>
                <p class="font-semibold text-slate-800 text-lg">{{ $item->dataAnak->nama_anak }}</p>
            </div>

            <!-- Detail lainnya menggunakan komponen info-item sebelumnya -->
            <x-info-item label="Jenis Kelamin" :value="$item->dataAnak->jenis_kelamin" />
            <x-info-item label="Umur" :value="$item->dataAnak->umur_bulan . ' Bulan'" />
            <x-info-item label="Tinggi Badan" :value="$item->dataAnak->tinggi_badan . ' cm'" />
            <x-info-item label="Berat Badan" :value="$item->dataAnak->berat_badan . ' kg'" />
        </div>

        <hr class="border-emerald-100/70">

        <!-- PENJELASAN -->
        <div>
            <h4 class="text-xl font-bold mb-2 text-slate-900">
                Penjelasan <span class="text-emerald-500">Status Gizi</span>
            </h4>
            <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">
                {{ $item->penjelasan }}
            </p>
        </div>

        <hr class="border-emerald-100/70">

        <!-- REKOMENDASI -->
        <div>
            <h4 class="text-xl font-bold mb-2 text-slate-900">
                <span class="text-emerald-500">Rekomendasi</span> Pemenuhan Gizi
            </h4>
            <p class="text-sm leading-7 text-slate-700 whitespace-pre-line">
                {!! nl2br(e($item->rekomendasi)) !!}
            </p>
        </div>

    </div>

</details>