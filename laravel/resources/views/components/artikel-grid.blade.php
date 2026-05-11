@props(['artikels'])

<div id="tab-artikel" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse ($artikels as $artikel)

        <a href="{{ route('artikel.show', $artikel->id) }}" class="block">

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 flex flex-col h-full">

                <img 
                    src="{{ $artikel->gambar ? asset('storage/' . $artikel->gambar) : 'https://via.placeholder.com/800x600?text=No+Image' }}" 
                    alt="{{ $artikel->judul }}" 
                    class="w-full h-52 object-cover"
                >

                <div class="p-6 flex-1 flex flex-col">

                    <span class="w-fit px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold mb-3 border border-emerald-100">
                        {{ $artikel->kategori }}
                    </span>

                    <h3 class="font-bold text-lg text-slate-900 mb-2 leading-snug">
                        {{ $artikel->judul }}
                    </h3>

                    <p class="text-sm text-gray-500 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($artikel->isi), 140) }}
                    </p>

                </div>
            </div>

        </a>

    @empty

        <div class="col-span-3 text-center text-gray-500 py-10">
            Belum ada artikel.
        </div>

    @endforelse

</div>