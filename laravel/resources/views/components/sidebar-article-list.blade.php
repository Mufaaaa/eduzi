@props(['title', 'articles', 'hasImage' => false])

<div class="bg-white rounded-3xl shadow-sm p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-4">{{ $title }}</h3>

    <div class="space-y-4">
        @foreach($articles as $item)
            <a href="{{ route('artikel.show', $item->id) }}"
               class="flex gap-3 items-start hover:bg-gray-50 p-2 rounded-xl transition-all">
                
                @if($hasImage)
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-16 h-16 object-cover rounded-xl shrink-0">
                    @else
                        <div class="w-16 h-16 bg-gray-200 rounded-xl shrink-0"></div>
                    @endif
                @endif

                <div>
                    <p class="font-semibold text-gray-800 leading-snug">
                        {{ \Illuminate\Support\Str::limit($item->judul, $hasImage ? 45 : 50) }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</div>