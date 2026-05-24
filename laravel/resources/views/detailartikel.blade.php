@extends('layout.app')

@section('title', $artikel->judul)

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb Navigasi --}}
        <x-article-breadcrumb :title="$artikel->judul" />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- Sisi Kiri: Konten Utama Artikel --}}
            <div class="lg:col-span-8">
                <article class="bg-white rounded-3xl shadow-sm overflow-hidden">

                    {{-- Cover Image --}}
                    @if ($artikel->gambar)
                        <div class="w-full bg-gray-100 flex items-center justify-center p-6">
                            <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}"
                                 class="w-auto max-w-full h-auto max-h-130 object-contain rounded-2xl shadow-sm mx-auto">
                        </div>
                    @endif

                    <div class="p-8 sm:p-10">
                        {{-- Kategori Badge --}}
                        @if(!empty($artikel->kategori))
                            <div class="mb-4">
                                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $artikel->kategori }}
                                </span>
                            </div>
                        @endif

                        {{-- Judul Utama --}}
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                            {{ $artikel->judul }}
                        </h1>

                        {{-- Meta Info --}}
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-8">
                            <span>🗓 {{ $artikel->created_at ? $artikel->created_at->format('d M Y') : '-' }}</span>
                            <span>✍ Admin</span>
                        </div>

                        {{-- Isi Tulisan Artikel --}}
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! $artikel->isi !!}
                        </div>

                        {{-- Social Share Buttons --}}
                        <x-article-share :title="$artikel->judul" />
                    </div>
                </article>
            </div>

            {{-- Sisi Kanan: Sidebar Area --}}
            <aside class="lg:col-span-4 space-y-8">

                {{-- List Artikel Terbaru (Tanpa Gambar Mini) --}}
                @if(isset($latest) && $latest->count())
                    <x-sidebar-article-list title="Artikel Terbaru" :articles="$latest" />
                @endif

                {{-- List Artikel Lainnya (Dengan Gambar Mini) --}}
                @if(isset($sidebarArtikel) && $sidebarArtikel->count())
                    <x-sidebar-article-list title="Artikel Lainnya" :articles="$sidebarArtikel" :hasImage="true" />
                @endif

            </aside>
        </div>
    </div>
</div>

{{-- Style scope untuk merapikan render rich text editor / trix (.prose) --}}
<style>
.prose p { margin-bottom: 1.2rem; }
.prose h1, .prose h2, .prose h3 { font-weight: 800; color: #111827; margin-top: 2rem; margin-bottom: 1rem; }
.prose br { display: block; content: ""; margin-bottom: 0.75rem; }
.prose strong { font-weight: 700; color: #111827; }
.prose ul, .prose ol { margin-left: 1.5rem; margin-bottom: 1.2rem; }
.prose li { margin-bottom: 0.5rem; }
.prose blockquote { border-left: 4px solid #2563eb; padding-left: 1rem; margin: 1.5rem 0; font-style: italic; color: #374151; }
.prose a { color: #2563eb; font-weight: 800; text-decoration: underline; text-underline-offset: 4px; transition: color 0.2s ease; }
.prose a:hover { color: #1d4ed8; }
</style>
@endsection