
@extends('layout.app')

@section('title', 'Dashboard Pemantauan Anak')

@section('content')

<div class="min-h-screen bg-slate-50 py-8">

    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-[#186490] sm:text-3xl">
                    Dashboard Pemantauan Anak
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Pantau kondisi dan status gizi anak
                </p>
            </div>
            <a
                href="{{ route('kalkulator') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#186490] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#125174] hover:shadow-md"
            >
                <i class="fas fa-plus"></i>
                Pemeriksaan Baru
            </a>
        </div>


        {{-- =====================================================
             JIKA TIDAK ADA DATA
        ====================================================== --}}
        @if(!$anak)

            <div class="rounded-2xl border border-slate-100 bg-white px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[#eaf5fb] text-[#186490]">
                    <i class="fas fa-user-plus text-3xl"></i>
                </div>

                <h4 class="mt-5 text-xl font-bold text-slate-800">
                    Belum Ada Data Anak
                </h4>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    Silakan lakukan pemeriksaan gizi terlebih dahulu untuk mulai memantau kondisi anak.
                </p>

                <div class="mt-6">
                    <a
                        href="{{ route('kalkulator') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#186490] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#125174] hover:shadow-md"
                    >
                        <i class="fas fa-clipboard-check"></i>
                        Mulai Pemeriksaan
                    </a>
                </div>

            </div>

        @else

            {{-- =================================================
                 PILIH ANAK
            ================================================== --}}

            @if(isset($anakList) && $anakList->count() > 1)

                <div class="mb-5 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">

                    <form
                        method="GET"
                        action="{{ route('pemantauan') }}"
                    >

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            <i class="fas fa-users mr-1 text-[#186490]"></i>
                            Pilih Anak
                        </label>

                        <select
                            name="anak"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-[#186490] focus:ring-2 focus:ring-[#186490]/10"
                            onchange="this.form.submit()"
                        >

                            @foreach($anakList as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ $anak->id == $item->id ? 'selected' : '' }}
                                >
                                    {{ $item->nama_anak }}
                                </option>

                            @endforeach

                        </select>

                    </form>

                </div>

            @endif


            {{-- =================================================
                 INFORMASI ANAK
            ================================================== --}}

            <div class="relative mb-6 overflow-hidden rounded-2xl bg-gradient-to-br from-[#186490] to-[#247da8] text-white shadow-sm">

                {{-- Dekorasi --}}
                <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-20 right-20 h-32 w-32 rounded-full bg-white/5"></div>

                <div class="relative p-6 sm:p-7">

                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                        <div class="flex items-center">

                            <div class="mr-4 flex h-16 w-16 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/15 sm:h-[72px] sm:w-[72px]">
                                <i class="fas fa-user text-2xl sm:text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold sm:text-2xl">
                                    {{ $anak->nama_anak }}
                                </h3>

                                <div class="mt-1 flex flex-wrap items-center gap-2 text-sm text-white/90">

                                    <span>
                                        <i class="fas fa-venus-mars mr-1"></i>
                                        {{ $anak->jenis_kelamin }}
                                    </span>

                                    <span class="text-white/50">•</span>

                                    <span>
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $anak->umur_bulan }} bulan
                                    </span>
                                </div>

                                @if($terakhir)
                                    <div class="mt-2 text-xs text-white/70">
                                        <i class="far fa-clock mr-1"></i>
                                        Pemeriksaan terakhir:
                                        {{ $terakhir->created_at->format('d F Y') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <a
                                href="{{ route('grafik.perkembangan', ['anak' => $anak->id]) }}"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-[#186490] shadow-sm transition hover:bg-slate-50 lg:w-auto"
                            >
                                <i class="fas fa-chart-line"></i>
                                Lihat Perkembangan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =================================================
                 RINGKASAN DATA
            ================================================== --}}

            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                {{-- BERAT BADAN --}}

                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="mr-4 flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#eaf5fb] text-[#186490]">
                            <i class="fas fa-weight text-lg"></i>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-slate-400">
                                Berat Badan
                            </div>
                            <div class="mt-1 text-2xl font-bold text-slate-800">
                                {{ number_format($anak->berat_badan, 1) }}
                                <span class="text-sm font-medium text-slate-400">
                                    kg
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- TINGGI BADAN --}}

                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="mr-4 flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#eaf5fb] text-[#186490]">
                            <i class="fas fa-ruler-vertical text-lg"></i>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-slate-400">
                                Tinggi Badan
                            </div>
                            <div class="mt-1 text-2xl font-bold text-slate-800">
                                {{ number_format($anak->tinggi_badan, 1) }}
                                <span class="text-sm font-medium text-slate-400">
                                    cm
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- BMI --}}

                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="mr-4 flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#eaf5fb] text-[#186490]">
                            <i class="fas fa-heartbeat text-lg"></i>
                        </div>
                        <div>

                            <div class="text-xs font-medium text-slate-400">
                                BMI
                            </div>

                            <div class="mt-1 text-2xl font-bold text-slate-800">

                                @if($terakhir)
                                    {{ number_format($terakhir->bmi, 2) }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                {{-- STATUS GIZI --}}

                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="text-xs font-medium text-slate-400">
                        Status Gizi
                    </div>
                    <div class="mt-3">

                        @if($terakhir)

                            @php

                                $status = strtolower($terakhir->hasil_prediksi);

                                if (str_contains($status, 'normal')) {

                                    $statusClass = 'bg-green-100 text-green-700';

                                } elseif (str_contains($status, 'stunting')) {

                                    $statusClass = 'bg-amber-100 text-amber-700';

                                } else {

                                    $statusClass = 'bg-red-100 text-red-700';
                                }
                            @endphp
                            <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold {{ $statusClass }}">
                                <span class="h-2 w-2 rounded-full bg-current"></span>
                                {{ $terakhir->hasil_prediksi }}
                            </span>
                        @else
                            <span class="text-sm text-slate-400">
                                Belum tersedia
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- =================================================
                 DETAIL PEMERIKSAAN TERAKHIR
            ================================================== --}}
            @if($terakhir)
                <div class="mb-5 rounded-2xl border border-slate-100 bg-white shadow-sm">
                    <div class="p-6">
                        <div class="mb-5 flex items-center">
                            <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl bg-[#eaf5fb] text-[#186490]">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <h5 class="text-base font-bold text-slate-800">
                                Hasil Pemeriksaan Terakhir
                            </h5>
                        </div>
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                            <div class="md:col-span-2">
                                <div class="mb-1 text-xs font-medium text-slate-400">
                                    Penjelasan
                                </div>
                                <p class="text-sm leading-7 text-slate-600">
                                    {{ $terakhir->penjelasan }}
                                </p>
                            </div>
                            <div>
                                <div class="mb-1 text-xs font-medium text-slate-400">
                                    Tanggal Pemeriksaan
                                </div>
                                <p class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                    <i class="far fa-calendar-check text-[#186490]"></i>
                                    {{ $terakhir->created_at->format('d F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- =================================================
                     REKOMENDASI
                ================================================== --}}
                <div class="mb-6 rounded-2xl border-l-4 border-[#186490] bg-[#f0f8fc] p-5 sm:p-6">
                    <div class="flex items-start">
                        <div class="mr-4 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#dceff8] text-[#186490]">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base font-bold text-slate-800">
                                Rekomendasi
                            </h5>
                            <p class="text-sm leading-7 text-slate-600">
                                {{ $terakhir->rekomendasi }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
