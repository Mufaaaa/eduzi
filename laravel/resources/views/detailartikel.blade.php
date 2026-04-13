@extends('layout.app')

@section('title', $artikel->judul)

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-6">
            @php
                $homeUrl = auth()->check() ? url('/home') : url('/');
            @endphp

            <a href="{{ $homeUrl }}" class="hover:text-blue-600">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('artikelvideo') }}" class="hover:text-blue-600">Artikel</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-medium">{{ \Illuminate\Support\Str::limit($artikel->judul, 40) }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- Content Artikel --}}
            <div class="lg:col-span-8">
                <article class="bg-white rounded-3xl shadow-sm overflow-hidden">

                    {{-- Cover Image --}}
                    @if ($artikel->gambar)
                        <div class="w-full bg-gray-100 flex items-center justify-center p-6">
                            <img src="{{ asset('storage/' . $artikel->gambar) }}"
                                 alt="{{ $artikel->judul }}"
                                 class="w-auto max-w-full h-auto max-h-[520px] object-contain rounded-2xl shadow-sm mx-auto">
                        </div>
                    @endif

                    <div class="p-8 sm:p-10">
                        {{-- Kategori --}}
                        @if(!empty($artikel->kategori))
                            <div class="mb-4">
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $artikel->kategori }}
                                </span>
                            </div>
                        @endif

                        {{-- Judul --}}
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                            {{ $artikel->judul }}
                        </h1>

                        {{-- Meta Info --}}
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-8">
                            <span>🗓 {{ $artikel->created_at ? $artikel->created_at->format('d M Y') : '-' }}</span>
                            <span>✍ Admin</span>
                        </div>

                        {{-- Isi Artikel --}}
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! $artikel->isi !!}
                        </div>

                        {{-- Share Button --}}
                        <div class="border-t mt-10 pt-6 flex flex-wrap gap-3 items-center">
                            <span class="text-gray-600 font-medium">Bagikan:</span>

                            <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="px-4 py-2 rounded-full bg-green-500 text-white text-sm hover:bg-green-600 transition">
                                WhatsApp
                            </a>

                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($artikel->judul) }}"
                               target="_blank"
                               class="px-4 py-2 rounded-full bg-black text-white text-sm hover:bg-gray-800 transition">
                                Twitter/X
                            </a>

                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="px-4 py-2 rounded-full bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
                                Facebook
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-4 space-y-8">

                {{-- Artikel Terbaru --}}
                @if(isset($latest) && $latest->count())
                    <div class="bg-white rounded-3xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Artikel Terbaru</h3>

                        <div class="space-y-4">
                            @foreach($latest as $item)
                                <a href="{{ route('artikel.show', $item->id) }}"
                                   class="block hover:text-blue-600 transition">
                                    <p class="font-semibold text-gray-800 leading-snug">
                                        {{ \Illuminate\Support\Str::limit($item->judul, 50) }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Artikel Lainnya --}}
                @if(isset($sidebarArtikel) && $sidebarArtikel->count())
                    <div class="bg-white rounded-3xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Artikel Lainnya</h3>

                        <div class="space-y-4">
                            @foreach($sidebarArtikel as $item)
                                <a href="{{ route('artikel.show', $item->id) }}"
                                   class="flex gap-3 items-start hover:bg-gray-50 p-2 rounded-xl transition">
                                    
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                             alt="{{ $item->judul }}"
                                             class="w-16 h-16 object-cover rounded-xl flex-shrink-0">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-xl flex-shrink-0"></div>
                                    @endif

                                    <div>
                                        <p class="font-semibold text-gray-800 leading-snug">
                                            {{ \Illuminate\Support\Str::limit($item->judul, 45) }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </aside>
        </div>
    </div>
</div>

{{-- Style isi artikel --}}
<style>
.prose p { margin-bottom: 1.2rem; }

.prose h1, .prose h2, .prose h3 {
    font-weight: 800;
    color: #111827;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose br {
    display: block;
    content: "";
    margin-bottom: 0.75rem;
}

.prose strong {
    font-weight: 700;
    color: #111827;
}

.prose ul, .prose ol {
    margin-left: 1.5rem;
    margin-bottom: 1.2rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose blockquote {
    border-left: 4px solid #2563eb;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #374151;
}

.prose a {
    color: #2563eb;
    font-weight: 800;
    text-decoration: underline;
    text-underline-offset: 4px;
    transition: color 0.2s ease;
}

.prose a:hover {
    color: #1d4ed8;
}
</style>
@endsection