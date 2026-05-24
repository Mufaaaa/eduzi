<a href="{{ route('google.login') }}"
   class="w-full flex items-center justify-center gap-3 border border-[#d9dfd7] bg-[#f8faf7] rounded-2xl py-4 text-[#18342d] font-semibold hover:bg-[#f3f6f1] transition shadow-sm">
    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
    {{ $slot->isEmpty() ? 'Masuk dengan Google' : $slot }}
</a>