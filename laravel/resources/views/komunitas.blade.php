@extends('layout.app')

@section('title', 'Berbagi Pengalaman')

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
                <span>Forum Komunitas</span>
            </div>

            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Berbagi <span class="text-emerald-500">Pengalaman</span> 
            </h1>

            <p class="mt-4 text-gray-500 text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                Diskusikan pertanyaan seputar gizi anak dengan komunitas dan ahli gizi.
            </p>
        </div>

        <!-- Card Form -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8" data-aos="fade-up" data-aos-delay="100">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-col sm:flex-row gap-3">
                    <textarea 
                        id="postingan" 
                        name="postingan" 
                        rows="6" 
                        placeholder="Tulis pertanyaan atau bagikan pengalaman Anda . . ."
                        class="w-full resize-none border-none bg-[#f7f9f7] border-emerald-300 p-2 text-sm text-slate-700 placeholder-slate-400 focus:ring-0 focus:outline-none"
                    ></textarea>
                </div>

                <!-- Tombol -->
                <div class="flex flex-col sm:flex-row gap-3 mt-6">
                    <button
                        type="submit"
                        class="flex-1 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-3 transition duration-200 shadow-sm"
                    >
                        <i class="fa-solid fa-check mr-2"></i>
                        Unggah
                    </button>

                </div>
            </form>
        </div>

        <hr class="my-8 border-slate-200">

        <!-- Hasil Dummy -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5">
            <x-post-card 
            name="Ibu Sari" 
            time="7 jam lalu" 
            likes="12" 
            comments="8" 
            avatar="https://randomuser.me/api/portraits/women/44.jpg"
            >
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </x-post-card>

            <x-post-card 
            name="Mom Uung" 
            time="12 jam lalu" 
            likes="689" 
            comments="52" 
            avatar="https://randomuser.me/api/portraits/women/44.jpg"
            >
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </x-post-card>
        </div>

    </div>
</div>
@endsection