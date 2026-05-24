@props(['label', 'value'])

<div class="bg-white rounded-xl p-4 border border-emerald-100">
    <p class="text-xs text-slate-500">
        {{ $label }}
    </p>
    <p class="font-semibold text-slate-800">
        {{ $value }}
    </p>
</div>