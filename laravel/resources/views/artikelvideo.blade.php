@extends('layout.app')

@section('title', 'Informasi Gizi Terpercaya')

@section('content')
<div class="min-h-screen bg-[#f7f9f7] py-12 px-4">

    <!-- Navbar -->
    @auth
        <x-navbar_home />
    @else
        <x-navbar_index />
    @endauth

    <div class="max-w-6xl mx-auto mt-8">

        <!-- Hero Artikel -->
        @include('components.hero-artikel')

        <!-- Search -->
        @include('components.search-artikel')

        <!-- Tabs -->
        @include('components.tabs-artikel')

        <!-- Artikel Grid -->
        @include('components.artikel-grid')

        <!-- Video Grid -->
        @include('components.video-grid')

        <!-- CTA -->
        @include('components.cta')

    </div>
</div>

        <!-- Script for Tabs -->
        @include('components.scripts-artikel-video')

@endsection