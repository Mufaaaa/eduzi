@props(['title'])

<nav class="text-sm text-gray-500 mb-6">
    <a href="{{ auth()->check() ? url('/home') : url('/') }}" class="hover:text-blue-600">Home</a>
    <span class="mx-2">/</span>
    <a href="{{ route('artikelvideo') }}" class="hover:text-blue-600">Artikel</a>
    <span class="mx-2">/</span>
    <span class="text-gray-800 font-medium">{{ \Illuminate\Support\Str::limit($title, 40) }}</span>
</nav>