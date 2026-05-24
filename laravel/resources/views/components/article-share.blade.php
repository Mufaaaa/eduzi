@props(['title'])

<div class="border-t mt-10 pt-6 flex flex-wrap gap-3 items-center">
    <span class="text-gray-600 font-medium">Bagikan:</span>

    <a href="https://wa.me/?text={{ urlencode($title . ' - ' . url()->current()) }}"
       target="_blank" class="px-4 py-2 rounded-full bg-green-500 text-white text-sm hover:bg-green-600 transition">
       WhatsApp
    </a>

    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($title) }}"
       target="_blank" class="px-4 py-2 rounded-full bg-black text-white text-sm hover:bg-gray-800 transition">
       Twitter/X
    </a>

    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
       target="_blank" class="px-4 py-2 rounded-full bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
       Facebook
    </a>
</div>