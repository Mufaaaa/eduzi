@props(['icon', 'title', 'portion', 'description', 'source', 'delay' => '100'])

<div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="flex items-start gap-3 mb-4">
        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">
            <i class="{{ $icon }}"></i>
        </div>
        <div>
            <h3 class="text-base font-bold text-slate-900">{{ $title }}</h3>
            <p class="text-xs text-slate-400">{{ $portion }}</p>
        </div>
    </div>

    <p class="text-sm text-slate-500 leading-7 mb-4">{{ $description }}</p>

    <div class="rounded-full bg-orange-100 text-orange-700 text-xs px-3 py-2">
        Sumber: {{ $source }}
    </div>
</div>