<div class="max-w-2xl mx-auto mb-8" data-aos="fade-up" data-aos-delay="100">
            <form action="{{ route('artikelvideo') }}" method="GET" class="flex gap-3">
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul artikel dan video..."
                    class="w-full rounded-2xl border border-slate-200 px-6 py-4 text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm"
                >

                <button 
                    type="submit"
                    class="px-6 py-4 rounded-2xl bg-emerald-500 text-white font-semibold hover:bg-emerald-600 transition"
                >
                    Cari
                </button>
            </form>
</div>