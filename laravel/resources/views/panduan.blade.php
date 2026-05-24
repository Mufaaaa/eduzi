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

        <x-page-header 
            badge="Panduan Gizi" 
            title="Panduan <span class='text-emerald-500'>Gizi Seimbang</span> untuk Anak" 
            subtitle="Panduan lengkap kebutuhan gizi anak berdasarkan usia, jenis nutrisi, dan porsi harian yang direkomendasikan." 
        />

        <div class="mt-10 flex justify-center">
            <div class="w-28 h-28 rounded-full bg-white shadow-sm border border-slate-200 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/nutrition-guide.png') }}" alt="Panduan Gizi" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="mb-16">
            <x-section-header-panduan 
                title="Panduan Berdasarkan <span class='text-emerald-500'>Usia</span>" 
                subtitle="Kebutuhan gizi anak berbeda di setiap tahap pertumbuhan." 
            />

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <x-age-card-panduan 
                    age="0–6 Bulan" 
                    title="ASI Eksklusif" 
                    description="Bayi hanya membutuhkan ASI selama 6 bulan pertama. ASI mengandung semua nutrisi yang dibutuhkan bayi."
                    :points="['ASI eksklusif tanpa tambahan apapun', 'Susui minimal 8–12 kali sehari', 'Pastikan posisi menyusui benar']"
                    delay="100"
                />

                <x-age-card-panduan 
                    age="6–12 Bulan" 
                    title="MPASI Pertama" 
                    description="Mulailah perkenalkan makanan pendamping ASI secara bertahap dengan tekstur yang sesuai."
                    :points="['Mulai dengan bubur halus saring', 'Kenalkan makanan baru setiap 3 hari sekali', 'Tetap berikan ASI sebagai makanan utama']"
                    delay="200"
                />

                <x-age-card-panduan
                    icon="fa-regular fa-face-smile"
                    age="1–3 Tahun" 
                    title="Makanan Keluarga" 
                    description="Anak mulai bisa makan makanan keluarga dengan tekstur dan porsi yang disesuaikan."
                    :points="['Berikan 3 kali makanan utama + 2 kali selingan', 'Variasikan jenis makanan setiap hari', 'Hindari makanan tinggi gula dan garam']"
                    delay="300"
                />
            </div>
        </div>

        <div class="pb-8">
            <x-section-header-panduan
                title="Jenis <span class='text-emerald-500'>Nutrisi</span> Penting" 
                subtitle="Kenali nutrisi esensial dan sumber makanannya untuk anak." 
            />

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <x-nutri-card-panduan icon="fa-regular fa-egg" title="Protein" portion="2–3 porsi/hari" description="Membangun dan memperbaiki jaringan dalam tubuh." source="Telur, ikan, daging, tempe, tahu, dll." delay="100" />
                <x-nutri-card-panduan icon="fa-regular fa-lemon" title="Vitamin & Mineral" portion="3–5 porsi/hari" description="Menjaga daya tahan tubuh dan fungsi organ." source="Sayuran hijau, wortel, brokoli, dll." delay="150" />
                <x-nutri-card-panduan icon="fa-regular fa-bowl-rice" title="Karbohidrat" portion="3–5 porsi/hari" description="Sumber energi utama untuk aktivitas." source="Nasi, roti, kentang, ubi, jagung, dll." delay="200" />
                <x-nutri-card-panduan icon="fa-solid fa-seedling" title="Serat" portion="2–3 porsi/hari" description="Kaya serat dan vitamin untuk pencernaan." source="Pisang, pepaya, jeruk, mangga, dll." delay="250" />
                <x-nutri-card-panduan icon="fa-solid fa-glass-water" title="Kalsium" portion="2–3 porsi/hari" description="Menguatkan tulang dan gigi anak." source="Susu, keju, yogurt, ikan teri, dll." delay="300" />
                <x-nutri-card-panduan icon="fa-solid fa-droplet" title="Air & Cairan" portion="6–8 gelas/hari" description="Menjaga hidrasi dan metabolisme tubuh." source="Air putih, kuah sayur, jus buah, dll." delay="350" />
            </div>
        </div>

    </div>
</div>

@include('components.footerindex')
@endsection