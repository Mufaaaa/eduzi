@extends('layout.app')

@section('title', 'Informasi Gizi Terpercaya')

@php
    function youtubeEmbedUrl($url)
    {
        if (!$url) return null;

        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        preg_match('/(?:youtu\.be\/|youtube\.com\/watch\?v=)([^&\?\s]+)/', $url, $matches);

        return isset($matches[1])
            ? 'https://www.youtube.com/embed/' . $matches[1]
            : null;
    }
@endphp

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
                <i class="fa-solid fa-photo-film"></i>
                <span>Artikel Edukasi & Video Edukasi</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Informasi <span class="text-emerald-500">Gizi</span> Terpercaya
            </h1>

            <p class="mt-4 text-gray-500 text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                Artikel informatif seputar gizi anak, kehamilan, dan pola makan sehat untuk keluarga.
            </p>
        </div>

        <div class="max-w-2xl mx-auto mb-8" data-aos="fade-up" data-aos-delay="100">
            <form action="{{ route('artikelvideo') }}" method="GET" class="flex gap-3">
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul artikel dan video..."
                    class="w-full rounded-2xl border border-slate-200 px-6 py-4 text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm"
                >

                <button 
                    type="submit"
                    class="px-6 py-4 rounded-2xl bg-emerald-500 text-white font-semibold hover:bg-emerald-600 transition"
                >
                    Cari
                </button>
            </form>
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
    
            @forelse ($artikels as $artikel)
                <a href="{{ route('artikel.show', $artikel->id) }}" class="block">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 flex flex-col h-full">
                        <img 
                            src="{{ $artikel->gambar ? asset('storage/' . $artikel->gambar) : 'https://via.placeholder.com/800x600?text=No+Image' }}" 
                            alt="{{ $artikel->judul }}" 
                            class="w-full h-52 object-cover"
                        >
                        <div class="p-6 flex-1 flex flex-col">
                            <span class="w-fit px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold mb-3 border border-emerald-100">
                                {{ $artikel->kategori }}
                            </span>
                            <h3 class="font-bold text-lg text-slate-900 mb-2 leading-snug">
                                {{ $artikel->judul }}
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($artikel->isi), 140) }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-500 py-10">
                    Belum ada artikel.
                </div>
            @endforelse

        </div>

        <div id="tab-video" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 hidden">
            
            @forelse ($videos as $video)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 flex flex-col group">
                    <div class="relative">
                        @php
                            $embedUrl = youtubeEmbedUrl($video->url_video);
                        @endphp

                        @if ($embedUrl)
                            <iframe
                                class="w-full h-52"
                                src="{{ $embedUrl }}"
                                title="{{ $video->judul }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        @else
                            <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                                Video tidak valid
                            </div>
                        @endif
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="font-bold text-md text-slate-900 leading-snug mb-2">
                            {{ $video->judul }}
                        </h3>
                        <p class="text-sm text-gray-500 line-clamp-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($video->deskripsi), 120) }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-500 py-10">
                    Belum ada video.
                </div>
            @endforelse

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

        const activeClasses = "px-10 py-3 rounded-xl font-bold text-white bg-emerald-500 shadow-md transition-all duration-200 w-36 text-center border-2 border-emerald-500";
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

    document.addEventListener('DOMContentLoaded', function () {
        const hasSearch = @json(request()->filled('search'));
        const artikelCount = {{ $artikels->count() }};
        const videoCount = {{ $videos->count() }};

        if (hasSearch && artikelCount === 0 && videoCount > 0) {
            switchTab('video');
        } else {
            switchTab('artikel');
        }
    });
</script>
@endsection