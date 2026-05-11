@props(['artikels', 'videos'])

<script>
    function switchTab(tab) {
        const btnArtikel = document.getElementById('btn-artikel');
        const btnVideo = document.getElementById('btn-video');
        const tabArtikel = document.getElementById('tab-artikel');
        const tabVideo = document.getElementById('tab-video');

        const activeClasses = "px-10 py-3 rounded-xl font-bold text-white bg-emerald-500 shadow-md transition-all duration-200 w-36 text-center border-2 border-emerald-500";
        const inactiveClasses = "px-10 py-3 rounded-xl font-bold text-emerald-600 bg-white border-2 border-emerald-500 shadow-sm hover:bg-emerald-50 transition-all duration-200 w-36 text-center";

        if (tab === 'artikel') {
            btnArtikel.className = activeClasses;
            btnVideo.className = inactiveClasses;
            tabArtikel.classList.remove('hidden');
            tabVideo.classList.add('hidden');
        } else {
            btnVideo.className = activeClasses;
            btnArtikel.className = inactiveClasses;
            tabVideo.classList.remove('hidden');
            tabArtikel.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {

        const hasSearch = @json(request()->filled('search'));
        const artikelCount = {{ $artikels->count() }};
        const videoCount = {{ $videos->count() }};

        if (hasSearch && artikelCount === 0 && videoCount > 0) {
            switchTab('video');
        } else {
            switchTab('artikel');
        }

    });
</script>