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
        <x-page-header 
            badge="Riwayat" 
            title="Lihat <span class='text-emerald-500'>Riwayat</span> Gizi Anak" 
            subtitle="Anda dapat melihat riwayat penggunaan kalkulator gizi disini." 
        />

        <!-- Card Background Container -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8"
             data-aos="fade-up"
             data-aos-delay="100">

            <span class="block text-xl font-semibold text-black-600 mb-2">
                Riwayat Kalkulator Gizi
            </span>

            <!-- Loop data dengan komponen baru yang sudah bisa buka-tutup -->
            @foreach ($riwayat as $item)
                <x-riwayat-card :item="$item" />
            @endforeach

             <!-- Jika tidak ada data riwayat -->
             @if ($riwayat->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-sm">Belum ada riwayat penggunaan kalkulator gizi.</p>
                </div>
            @endif
        </div>

    </div>

</div>
@endsection