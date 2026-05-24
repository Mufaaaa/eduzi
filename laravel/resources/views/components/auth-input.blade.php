@props(['id', 'name', 'type' => 'text', 'label', 'icon', 'placeholder', 'value' => ''])

<div>
    <div class="flex items-center justify-between mb-3">
        <label for="{{ $id }}" class="block text-[#16352d] font-medium">
            {{ $label }}
        </label>
        {{ $labelLink ?? '' }}
    </div>

    <div class="flex items-center gap-3 border border-[#d9dfd7] rounded-2xl px-4 py-4 bg-[#f8faf7] focus-within:border-[#49a35a] transition">
        <i class="{{ $icon }} text-[#7b8e84]"></i>
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full bg-transparent outline-none text-[#16352d] placeholder:text-[#8ca096]']) }}
        >
        {{ $append ?? '' }}
    </div>

    @error($name)
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>