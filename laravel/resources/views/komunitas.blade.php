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

        <x-page-header 
            badge="Forum Komunitas" 
            title="Berbagi <span class='text-emerald-500'>Pengalaman</span>" 
            subtitle="Diskusikan pertanyaan seputar gizi anak dengan komunitas dan ahli gizi." 
        />

        <x-alert-messages />

        <x-create-post-form />

        <hr class="my-8 border-slate-200">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5">

            @forelse($data as $item)
                <x-post-item :item="$item" />
            @empty
                <div class="col-span-2 text-center text-gray-500 py-10">
                    Belum ada postingan komunitas saat ini 😢
                </div>
            @endforelse

        </div>

    </div>
</div>
@endsection