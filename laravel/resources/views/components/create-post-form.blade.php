<div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8">
    <form action="{{ route('komunitas.store') }}" method="POST">
        @csrf

        <textarea 
            name="postingan"
            rows="5"
            class="w-full bg-[#f7f9f7] p-3 rounded-xl border border-transparent focus:border-emerald-400 outline-none transition"
            placeholder="Tulis cerita atau pertanyaan Anda di sini..."
        >{{ old('postingan') }}</textarea>

        <button class="mt-4 bg-emerald-500 text-white px-5 py-2 rounded-xl font-semibold hover:bg-emerald-600 transition">
            Unggah Postingan
        </button>
    </form>
</div>