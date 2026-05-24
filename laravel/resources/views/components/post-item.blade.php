@props(['item'])

<x-post-card 
    name="{{ $item->user->name ?? 'Guest' }}"
    time="{{ $item->created_at->diffForHumans() }}"
    likes="{{ $item->likes->count() }}"
    comments="{{ $item->komentar->count() }}"
    avatar="https://ui-avatars.com/api/?name={{ urlencode($item->user->name ?? 'Guest') }}"
>
    <p class="text-slate-800 leading-relaxed">{{ $item->isi }}</p>

    <form action="{{ route('like.store') }}" method="POST" class="mt-2.5">
        @csrf
        <input type="hidden" name="komunitas_id" value="{{ $item->id }}">
        <button class="text-sm text-gray-500 hover:text-red-500 transition">
            ❤️ {{ $item->likes->count() }}
        </button>
    </form>

    <form action="{{ route('komentar.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="komunitas_id" value="{{ $item->id }}">

        <textarea 
            name="isi"
            rows="2"
            class="w-full border border-slate-200 rounded-xl p-2.5 text-sm outline-none focus:border-emerald-400 transition placeholder:text-gray-400"
            placeholder="Tulis komentar..."
        ></textarea>

        <button class="mt-2 bg-emerald-500 text-white px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-emerald-600 transition">
            Kirim
        </button>
    </form>

    @if($item->komentar->count() > 0)
        <div class="mt-4 pt-3 border-t border-slate-100 space-y-2.5">
            @foreach($item->komentar as $komen)
                <x-comment-item :komen="$komen" :itemId="$item->id" />
            @endforeach
        </div>
    @endif
</x-post-card>