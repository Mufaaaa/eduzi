@props(['id', 'name', 'label', 'placeholder'])

<div>
    <label for="{{ $id }}" class="mb-2 block text-base font-semibold text-[#162323]">
        {{ $label }}
    </label>
    <div class="relative">
        <input
            type="password"
            id="{{ $id }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            required
            {{ $attributes->merge(['class' => 'h-14 w-full rounded-xl border border-[#d7dfd8] bg-[#f8faf7] px-4 pr-12 text-base text-[#223030] outline-none transition focus:border-[#86c8a5] focus:bg-white']) }}
        >
        <button
            type="button"
            class="absolute right-4 top-1/2 -translate-y-1/2 border-0 bg-transparent text-base text-[#738279]"
            onclick="togglePassword('{{ $id }}', this)"
        >
            <i class="fa fa-eye"></i>
        </button>
    </div>
    
    {{-- Otomatis menampilkan error validasi per field --}}
    @error($name)
        <div class="mt-2 text-sm text-[#d93025]">{{ $message }}</div>
    @enderror
</div>