@props(['komen', 'itemId'])

<div class="bg-gray-50 p-3 rounded-xl text-sm border border-slate-100">
    <div class="font-semibold text-slate-800">
        {{ $komen->user->name ?? 'Guest' }}
        @if($komen->replyTo)
            <span class="text-xs font-normal text-gray-400 ml-1">
                → {{ $komen->replyTo->name }}
            </span>
        @endif
    </div>

    <p class="text-slate-700 mt-1">{{ $komen->isi }}</p>

    <form action="{{ route('like.store') }}" method="POST" class="mt-1.5">
        @csrf
        <input type="hidden" name="komentar_id" value="{{ $komen->id }}">
        <button class="text-xs text-gray-400 hover:text-red-500 transition">
            ❤️ {{ $komen->likes->count() }}
        </button>
    </form>

    <form action="{{ route('komentar.store') }}" method="POST" class="mt-2">
        @csrf
        <input type="hidden" name="komunitas_id" value="{{ $itemId }}">
        <input type="hidden" name="reply_to_user_id" value="{{ $komen->user?->id }}">

        <input 
            type="text"
            name="isi"
            placeholder="Balas {{ $komen->user?->name ?? 'Guest' }}..."
            class="w-full border border-slate-200 bg-white rounded-lg p-1.5 text-xs outline-none focus:border-emerald-400 transition"
        >
    </form>
</div>