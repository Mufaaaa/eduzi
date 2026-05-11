@props(['videos'])

@php
function youtubeEmbedUrl($url)
{
    if (!$url) return null;

    if (str_contains($url, 'youtube.com/embed/')) {
        return $url;
    }

    preg_match('/(?:youtu\.be\/|youtube\.com\/watch\?v=)([^&\?\s]+)/', $url, $matches);

    return isset($matches[1])
        ? 'https://www.youtube.com/embed/' . $matches[1]
        : null;
}
@endphp

<div id="tab-video" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 hidden">

    @forelse ($videos as $video)

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-md transition duration-300 flex flex-col group">

            <div class="relative">

                @php
                    $embedUrl = youtubeEmbedUrl($video->url_video);
                @endphp

                @if ($embedUrl)

                    <iframe
                        class="w-full h-52"
                        src="{{ $embedUrl }}"
                        title="{{ $video->judul }}"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>

                @else

                    <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                        Video tidak valid
                    </div>

                @endif

            </div>

            <div class="p-5 flex-1 flex flex-col">

                <h3 class="font-bold text-md text-slate-900 leading-snug mb-2">
                    {{ $video->judul }}
                </h3>

                <p class="text-sm text-gray-500 line-clamp-3">
                    {{ \Illuminate\Support\Str::limit(strip_tags($video->deskripsi), 120) }}
                </p>

            </div>

        </div>

    @empty

        <div class="col-span-3 text-center text-gray-500 py-10">
            Belum ada video.
        </div>

    @endforelse

</div>