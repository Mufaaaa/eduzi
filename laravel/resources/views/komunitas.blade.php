@extends('layout.app')

@section('title', 'Berbagi Pengalaman')

@section('content')
<div class="min-h-screen bg-[#f7f9f7] py-12 px-4">

    @auth
        <x-navbar_home />
    @else
        <x-navbar_index />
    @endauth

    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-10" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-sm font-medium border border-emerald-100">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Forum Komunitas</span>
            </div>

            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">
                Berbagi <span class="text-emerald-500">Pengalaman</span> 
            </h1>

            <p class="mt-4 text-gray-500 text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                Diskusikan pertanyaan seputar gizi anak dengan komunitas dan ahli gizi.
            </p>
        </div>

        <!-- ALERT -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- VALIDATION ERROR -->
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM POST -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8">
            <form action="{{ route('komunitas.store') }}" method="POST">
                @csrf

                <textarea 
                    name="postingan"
                    rows="6"
                    class="w-full bg-[#f7f9f7] p-3 rounded-xl"
                    placeholder="Tulis sesuatu..."
                >{{ old('postingan') }}</textarea>

                <button class="mt-4 bg-emerald-500 text-white px-4 py-2 rounded-xl">
                    Unggah
                </button>
            </form>
        </div>

        <hr class="my-8 border-slate-200">

        <!-- DATA POST -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5">

        @forelse($data as $item)
            <x-post-card 
                name="{{ $item->user->name ?? 'Guest' }}"
                time="{{ $item->created_at->diffForHumans() }}"
                likes="{{ $item->likes->count() }}"
                comments="{{ $item->komentar->count() }}"
                avatar="https://ui-avatars.com/api/?name={{ urlencode($item->user->name ?? 'Guest') }}"
            >

                <!-- ISI POST -->
                <p>{{ $item->isi }}</p>

                <!-- LIKE POST -->
                <form action="{{ route('like.store') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="komunitas_id" value="{{ $item->id }}">
                    <button class="text-sm text-gray-500 hover:text-red-500">
                        ❤️ {{ $item->likes->count() }}
                    </button>
                </form>

                <!-- FORM KOMENTAR -->
                <form action="{{ route('komentar.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="komunitas_id" value="{{ $item->id }}">

                    <textarea 
                        name="isi"
                        class="w-full border rounded p-2 text-sm"
                        placeholder="Tulis komentar..."
                    ></textarea>

                    <button class="mt-2 bg-emerald-500 text-white px-3 py-1 rounded text-sm">
                        Kirim
                    </button>
                </form>

                <!-- LIST KOMENTAR -->
                <div class="mt-3 space-y-2">

                    @foreach($item->komentar as $komen)
                        <div class="bg-gray-50 p-2 rounded text-sm">

                            <b>{{ $komen->user->name ?? 'Guest' }}</b>

                            @if($komen->replyTo)
                                <span class="text-gray-500">
                                    → {{ $komen->replyTo->name }}
                                </span>
                            @endif

                            <p>{{ $komen->isi }}</p>

                            <!-- LIKE KOMENTAR -->
                            <form action="{{ route('like.store') }}" method="POST" class="mt-1">
                                @csrf
                                <input type="hidden" name="komentar_id" value="{{ $komen->id }}">
                                <button class="text-xs text-gray-400 hover:text-red-500">
                                    ❤️ {{ $komen->likes->count() }}
                                </button>
                            </form>

                            <!-- BALAS -->
                            <form action="{{ route('komentar.store') }}" method="POST" class="mt-1">
                                @csrf
                                <input type="hidden" name="komunitas_id" value="{{ $item->id }}">
                                <input type="hidden" name="reply_to_user_id" value="{{ $komen->user->id }}">

                                <input 
                                    type="text"
                                    name="isi"
                                    placeholder="Balas {{ $komen->user->name ?? 'Guest' }}..."
                                    class="w-full border rounded p-1 text-xs"
                                >
                            </form>

                        </div>
                    @endforeach

                </div>

            </x-post-card>
        @empty
            <div class="col-span-2 text-center text-gray-500">
                Belum ada postingan 😢
            </div>
        @endforelse

        </div>

    </div>
</div>
@endsection