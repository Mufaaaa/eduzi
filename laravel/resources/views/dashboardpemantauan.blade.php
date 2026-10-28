@extends('layout.app')

@section('title', 'Dashboard Pemantauan Anak')

@section('content')

<div class="min-h-screen bg-[#f6f8f3] py-8">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-[#e8f4ea] px-3 py-1.5 text-xs font-semibold text-[#3f8e4e]">
                    <i class="fas fa-leaf"></i>
                    Eduzi - Pemantauan Gizi
                </div>

                <h2 class="text-2xl font-bold tracking-tight text-[#1f3b2f] sm:text-3xl">
                    Dashboard Pemantauan Anak
                </h2>

                <p class="mt-1 text-sm text-[#708277]">
                    Pantau kondisi dan status gizi anak
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="/home"
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#dfe6dc] bg-white px-5 py-3 text-sm font-semibold text-[#334d40] shadow-sm transition hover:bg-[#f0f5ed]">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>

                <a href="{{ route('kalkulator') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#49a35a] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#3f8e4e]">
                    <i class="fas fa-plus"></i>
                    Pemeriksaan Baru
                </a>
            </div>
        </div>

        {{-- PESAN --}}
        @if(session('error'))
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- JIKA BELUM ADA DATA ANAK --}}
        @if(!$anak)

            <div class="rounded-2xl border border-[#e5ebdf] bg-white px-6 py-16 text-center shadow-sm">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[#e8f4ea] text-[#49a35a]">
                    <i class="fas fa-user-plus text-3xl"></i>
                </div>

                <h4 class="mt-5 text-xl font-bold text-[#1f3b2f]">
                    Belum Ada Data Anak
                </h4>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#708277]">
                    Silakan lakukan pemeriksaan gizi terlebih dahulu untuk mulai memantau kondisi anak.
                </p>

                <div class="mt-6">
                    <a href="{{ route('kalkulator') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-[#49a35a] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#3f8e4e]">
                        <i class="fas fa-clipboard-check"></i>
                        Mulai Pemeriksaan
                    </a>
                </div>
            </div>

        @else

            {{-- PILIH ANAK --}}
            @if($anakList->count() > 0)
                <div class="mb-5 rounded-2xl border border-[#e5ebdf] bg-white p-5 shadow-sm">
                    <form method="GET" action="{{ route('pemantauan') }}">
                        <label class="mb-2 block text-sm font-semibold text-[#334d40]">
                            <i class="fas fa-users mr-1 text-[#49a35a]"></i>
                            Pilih Anak
                        </label>

                        <select name="anak"
                                class="w-full rounded-xl border border-[#dfe6dc] bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-[#49a35a] focus:ring-2 focus:ring-[#49a35a]/20"
                                onchange="this.form.submit()">

                            @foreach($anakList as $item)
                                <option value="{{ $item->id }}"
                                    {{ mb_strtolower(trim($anak->nama_anak)) === mb_strtolower(trim($item->nama_anak)) ? 'selected' : '' }}>
                                    {{ $item->nama_anak }}
                                </option>
                            @endforeach

                        </select>
                    </form>

                    <p class="mt-2 text-xs text-slate-400">
                        Nama yang sama pada akun ini ditampilkan satu kali dan riwayat pemeriksaannya digabungkan.
                    </p>
                </div>
            @endif

            {{-- INFORMASI ANAK --}}
            <div class="relative mb-6 overflow-hidden rounded-2xl bg-gradient-to-br from-[#49a35a] to-[#287d3c] text-white shadow-sm">
                <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-20 right-20 h-32 w-32 rounded-full bg-white/5"></div>

                <div class="relative p-6 sm:p-7">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center">
                            <div class="mr-4 flex h-16 w-16 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/15 sm:h-[72px] sm:w-[72px]">
                                <i class="fas fa-child text-2xl sm:text-3xl"></i>
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
                                    <div class="mt-2 text-xs text-white/80">
                                        <i class="far fa-clock mr-1"></i>
                                        Pemeriksaan terakhir:
                                        {{ $terakhir->created_at->format('d F Y') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('grafik.perkembangan', ['anak' => $anak->id]) }}"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-[#3f8e4e] shadow-sm transition hover:bg-[#f0f5ed] lg:w-auto">
                            <i class="fas fa-chart-line"></i>
                            Lihat Perkembangan
                        </a>
                    </div>
                </div>
            </div>

            {{-- RINGKASAN DATA --}}
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                {{-- BERAT BADAN --}}
                <div class="rounded-2xl border border-[#e5ebdf] bg-white p-5 shadow-sm">
                    <div class="flex items-center">
                        <div class="mr-4 flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                            <i class="fas fa-weight text-lg"></i>
                        </div>

                        <div>
                            <div class="text-xs font-medium text-slate-400">Berat Badan</div>
                            <div class="mt-1 text-2xl font-bold text-[#1f3b2f]">
                                {{ number_format($anak->berat_badan, 1) }}
                                <span class="text-sm font-medium text-slate-400">kg</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TINGGI BADAN --}}
                <div class="rounded-2xl border border-[#e5ebdf] bg-white p-5 shadow-sm">
                    <div class="flex items-center">
                        <div class="mr-4 flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                            <i class="fas fa-ruler-vertical text-lg"></i>
                        </div>

                        <div>
                            <div class="text-xs font-medium text-slate-400">Tinggi Badan</div>
                            <div class="mt-1 text-2xl font-bold text-[#1f3b2f]">
                                {{ number_format($anak->tinggi_badan, 1) }}
                                <span class="text-sm font-medium text-slate-400">cm</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BMI --}}
                <div class="rounded-2xl border border-[#e5ebdf] bg-white p-5 shadow-sm">
                    <div class="flex items-center">
                        <div class="mr-4 flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                            <i class="fas fa-heartbeat text-lg"></i>
                        </div>

                        <div>
                            <div class="text-xs font-medium text-slate-400">BMI</div>
                            <div class="mt-1 text-2xl font-bold text-[#1f3b2f]">
                                @if($terakhir && $terakhir->bmi !== null)
                                    {{ number_format($terakhir->bmi, 2) }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATUS GIZI --}}
                <div class="rounded-2xl border border-[#e5ebdf] bg-white p-5 shadow-sm">
                    <div class="text-xs font-medium text-slate-400">Status Gizi</div>

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
                            <span class="text-sm text-slate-400">Belum tersedia</span>
                        @endif
                    </div>
                </div>

            </div>

            {{-- DETAIL PEMERIKSAAN TERAKHIR --}}
            @if($terakhir)
                <div class="mb-5 rounded-2xl border border-[#e5ebdf] bg-white shadow-sm">
                    <div class="p-6">
                        <div class="mb-5 flex items-center">
                            <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                                <i class="fas fa-clipboard-check"></i>
                            </div>

                            <h5 class="text-base font-bold text-[#1f3b2f]">
                                Hasil Pemeriksaan Terakhir
                            </h5>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                            <div class="md:col-span-2">
                                <div class="mb-1 text-xs font-medium text-slate-400">
                                    Penjelasan
                                </div>

                                <p class="text-sm leading-7 text-slate-600">
                                    {{ $terakhir->penjelasan ?: 'Belum ada penjelasan pemeriksaan.' }}
                                </p>
                            </div>

                            <div>
                                <div class="mb-1 text-xs font-medium text-slate-400">
                                    Tanggal Pemeriksaan
                                </div>

                                <p class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                    <i class="far fa-calendar-check text-[#49a35a]"></i>
                                    {{ $terakhir->created_at->format('d F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- REKOMENDASI --}}
                <div class="mb-6 rounded-2xl border-l-4 border-[#49a35a] bg-[#f0f8f0] p-5 sm:p-6">
                    <div class="flex items-start">
                        <div class="mr-4 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#e0f0e2] text-[#3f8e4e]">
                            <i class="fas fa-lightbulb"></i>
                        </div>

                        <div>
                            <h5 class="mb-1 text-base font-bold text-[#1f3b2f]">
                                Rekomendasi
                            </h5>

                            <p class="text-sm leading-7 text-slate-600">
                                {{ $terakhir->rekomendasi ?: 'Belum ada rekomendasi pemeriksaan.' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- SELURUH RIWAYAT PEMERIKSAAN --}}
            <div class="mb-6 rounded-2xl border border-[#e5ebdf] bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                        <i class="fas fa-history"></i>
                    </div>

                    <div>
                        <h5 class="font-bold text-[#1f3b2f]">
                            Riwayat Pemeriksaan
                        </h5>
                        <p class="text-xs text-slate-400">
                            Seluruh pemeriksaan {{ $anak->nama_anak }}
                        </p>
                    </div>
                </div>

                @if($riwayat->isNotEmpty())
                    <div class="space-y-3">
                        @foreach($riwayat as $pemeriksaan)
                            @php
                                $statusRiwayat = strtolower($pemeriksaan->hasil_prediksi);

                                if (str_contains($statusRiwayat, 'normal')) {
                                    $kelasRiwayat = 'bg-green-100 text-green-700';
                                } elseif (str_contains($statusRiwayat, 'stunting')) {
                                    $kelasRiwayat = 'bg-amber-100 text-amber-700';
                                } else {
                                    $kelasRiwayat = 'bg-red-100 text-red-700';
                                }
                            @endphp

                            <div class="flex flex-col justify-between gap-3 rounded-xl border border-[#e5ebdf] p-4 sm:flex-row sm:items-center">
                                <div>
                                    <p class="text-sm font-semibold text-[#1f3b2f]">
                                        Pemeriksaan {{ $loop->iteration }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $pemeriksaan->created_at->format('d F Y') }}
                                    </p>

                                    @if($pemeriksaan->dataAnak)
                                        <p class="mt-1 text-xs text-slate-500">
                                            Usia: {{ $pemeriksaan->dataAnak->umur_bulan }} bulan
                                            <span class="mx-1">•</span>
                                            Berat: {{ number_format($pemeriksaan->dataAnak->berat_badan, 1) }} kg
                                            <span class="mx-1">•</span>
                                            Tinggi: {{ number_format($pemeriksaan->dataAnak->tinggi_badan, 1) }} cm
                                        </p>
                                    @endif
                                </div>

                                <span class="inline-flex w-fit items-center rounded-full px-3 py-1.5 text-xs font-semibold {{ $kelasRiwayat }}">
                                    {{ $pemeriksaan->hasil_prediksi }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500">
                        Belum ada riwayat pemeriksaan untuk anak ini.
                    </p>
                @endif
            </div>

            {{-- CATATAN --}}
            <div class="mb-6 flex items-start gap-3 rounded-xl border border-[#e5ebdf] bg-white p-4">
                <i class="fas fa-info-circle mt-0.5 text-[#49a35a]"></i>
                <p class="text-xs leading-6 text-slate-500">
                    Informasi status gizi dan rekomendasi pada Eduzi merupakan sarana pemantauan awal, bukan pengganti diagnosis tenaga kesehatan. Konsultasikan kondisi dan pertumbuhan anak kepada tenaga kesehatan untuk penilaian lebih lanjut.
                </p>
            </div>

        @endif

    </div>
</div>

@endsection
