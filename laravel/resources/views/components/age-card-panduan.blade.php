@props(['icon' => 'fa-regular fa-heart', 'age', 'title', 'description', 'points' => [], 'delay' => '100'])

<div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="flex items-center justify-between mb-4">
        <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500">
            <i class="{{ $icon }}"></i>
        </div>
    </div>

    <span class="inline-block text-[11px] font-medium px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 mb-4">
        {{ $age }}
    </span>

    <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $title }}</h3>
    <p class="text-sm text-slate-500 leading-7 mb-4">{{ $description }}</p>

    @if(!empty($points))
        <ul class="list-disc pl-5 text-sm text-slate-700 leading-7 space-y-1">
            @foreach($points as $point)
                <li>{{ $point }}</li>
            @endforeach
        </ul>
    @endif
</div>