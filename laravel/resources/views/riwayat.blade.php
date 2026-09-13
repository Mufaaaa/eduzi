
@extends('layout.app')

@section('title', 'Pantau Status Gizi Anak')

@section('content')

<div class="min-h-screen bg-[#f7f9f7] py-12 px-4">

    @auth
        <x-navbar_home />
    @else
        <x-navbar_index />
    @endauth

    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <x-page-header
            badge="Riwayat"
            title="Lihat <span class='text-emerald-500'>Riwayat</span> Gizi Anak"
            subtitle="Anda dapat melihat riwayat penggunaan kalkulator gizi disini."
        />

        <!-- Card Background Container -->
        <div
            class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-8"
            data-aos="fade-up"
            data-aos-delay="100"
        >

            <span class="block text-xl font-semibold text-black-600 mb-2">
                Riwayat Kalkulator Gizi
            </span>

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">

                <!-- Form Filter -->
                <form
                    method="GET"
                    action="{{ route('riwayat') }}"
                    class="flex flex-col md:flex-row gap-3 items-end"
                >

                    <!-- Filter Nama Anak -->
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Nama Anak
                        </label>

                        <input
                            type="text"
                            name="nama_anak"
                            value="{{ request('nama_anak') }}"
                            placeholder="Nama anak"
                            class="border border-slate-300 rounded-lg px-4 py-2
                                   focus:ring-2 focus:ring-emerald-500
                                   focus:border-emerald-500"
                        >
                    </div>

                    <!-- Filter Tanggal -->
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Tanggal Tes
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ request('tanggal') }}"
                            class="border border-slate-300 rounded-lg px-4 py-2
                                   focus:ring-2 focus:ring-emerald-500
                                   focus:border-emerald-500"
                        >
                    </div>

                    <!-- Tombol Filter -->
                    <button
                        type="submit"
                        class="bg-emerald-500 hover:bg-emerald-600
                               text-white px-5 py-2 rounded-lg transition"
                    >
                        Filter
                    </button>

                    <!-- Tombol Reset -->
                    @if(request('nama_anak') || request('tanggal'))
                        <a
                            href="{{ route('riwayat') }}"
                            class="bg-slate-500 hover:bg-slate-600
                                   text-white px-5 py-2 rounded-lg transition"
                        >
                            Reset
                        </a>
                    @endif

                </form>

                <!-- Export PDF -->
                <a
                    href="{{ route('riwayat.export', [
                        'nama_anak' => request('nama_anak'),
                        'tanggal' => request('tanggal')
                    ]) }}"
                    class="bg-red-500 hover:bg-red-600
                           text-white px-5 py-2 rounded-lg transition"
                >
                    Export PDF
                </a>

            </div>

            <!-- Loop data -->
            @foreach ($riwayat as $item)
                <x-riwayat-card :item="$item" />
            @endforeach

            <!-- Jika tidak ada data riwayat -->
            @if ($riwayat->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-sm">
                        Belum ada riwayat penggunaan kalkulator gizi.
                    </p>
                </div>
            @endif

        </div>

    </div>

</div>

@endsection
