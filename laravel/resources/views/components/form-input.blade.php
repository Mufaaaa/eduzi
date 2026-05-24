@props(['label', 'type' => 'text', 'name', 'value' => ''])

<div>
    <label class="mb-2 block text-sm font-semibold text-slate-800">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'h-12 w-full rounded-xl border border-slate-300 bg-slate-50 px-4 text-sm outline-none transition focus:border-green-400 focus:bg-white']) }}
    >
</div>