@extends('layout.app')

@section('title', 'Beranda')

@section('content')
<div class="bg-[#f6f8f3] text-[#1f3b2f]">

    <!-- Navbar Index -->
    @include('components.navbar_index')

    <!-- Hero -->
    @include('components.hero-index')

    <!-- Fitur Utama -->
    @include('components.fitur')

    <!-- Artikel -->
    @include('components.artikel')

    <!-- Panduan -->
    @include('components.panduan')

    <!-- CTA -->
    @include('components.cta')

    <!-- Modal Popup -->
    @include('components.modal')

    <!-- Footer Index -->
    @include('components.footerindex')

</div>

<script>
    function openModal(title, content) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalContent').innerText = content;

        const modal = document.getElementById('featureModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
        const modal = document.getElementById('featureModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    document.getElementById('featureModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection