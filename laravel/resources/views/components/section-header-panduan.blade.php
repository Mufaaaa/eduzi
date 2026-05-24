@props(['title', 'subtitle'])

<div class="text-center mb-8" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
        {!! $title !!}
    </h2>
    <p class="mt-3 text-gray-500 text-base">
        {{ $subtitle }}
    </p>
</div>