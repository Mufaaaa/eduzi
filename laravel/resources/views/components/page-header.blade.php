@props([
    'badge', 
    'title', 
    'subtitle',
    'variant' => 'green' {{-- Default warna hijau biasa --}}
])

@php
    // Menentukan rumpun warna berdasarkan variant
    $bgBadge = $variant === 'emerald' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-green-100 text-green-600 border-transparent';
@endphp

<div class="text-center mb-10" data-aos="fade-up">
    <div class="inline-block rounded-full px-4 py-2 text-sm font-medium border {{ $bgBadge }}">
        {{ $badge }}
    </div>

    <h1 class="mt-5 text-3xl font-bold leading-tight text-slate-900 md:text-5xl">
        {!! $title !!}
    </h1>

    <p class="mx-auto mt-3 max-w-2xl text-sm leading-7 text-slate-500 md:text-base">
        {!! $subtitle !!}
    </p>
</div>