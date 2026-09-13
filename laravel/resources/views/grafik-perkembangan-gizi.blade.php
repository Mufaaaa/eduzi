
@extends('layout.app')

@section('title', 'Grafik Perkembangan Gizi')

@section('content')

<div class="min-h-screen bg-slate-50 py-8">

    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="flex items-center gap-2 text-2xl font-bold tracking-tight text-[#186490] sm:text-3xl">
                    <i class="fas fa-chart-line text-xl sm:text-2xl"></i>
                    Grafik Perkembangan Gizi
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Perkembangan pertumbuhan anak berdasarkan riwayat pemeriksaan
                </p>
            </div>

            <a
                href="{{ route('pemantauan', ['anak' => $anak->id]) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#186490] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#125174] hover:shadow-md"
            >
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

        </div>


        {{-- =====================================================
             INFORMASI ANAK
        ====================================================== --}}

        <div class="relative mb-6 overflow-hidden rounded-2xl bg-gradient-to-br from-[#186490] to-[#247da8] text-white shadow-sm">

            {{-- Dekorasi --}}
            <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-20 right-20 h-32 w-32 rounded-full bg-white/5"></div>

            <div class="relative p-6 sm:p-7">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center">

                        <div class="mr-4 flex h-16 w-16 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/15">

                            <i class="fas fa-user text-2xl"></i>

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

                        </div>

                    </div>


                    <div class="rounded-xl bg-white/10 px-5 py-3 sm:text-right">

                        <div class="text-2xl font-bold">
                            {{ $riwayat->count() }}
                        </div>

                        <div class="text-xs text-white/75">
                            Kali Pemeriksaan
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             GRAFIK BERAT BADAN
        ====================================================== --}}

        <div class="mb-6 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm sm:p-6">

            <div class="mb-5 flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#eaf5fb] text-[#186490]">
                    <i class="fas fa-chart-line"></i>
                </div>

                <div>

                    <h5 class="text-base font-bold text-slate-800 sm:text-lg">
                        Perkembangan Berat Badan
                    </h5>

                    <p class="mt-1 text-sm text-slate-500">
                        Perubahan berat badan anak berdasarkan pemeriksaan
                    </p>

                </div>

            </div>

            <div class="relative h-[300px] w-full sm:h-[350px]">
                <canvas id="grafikBerat"></canvas>
            </div>

        </div>


        {{-- =====================================================
             GRAFIK TINGGI BADAN
        ====================================================== --}}

        <div class="mb-6 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm sm:p-6">

            <div class="mb-5 flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#eaf5fb] text-[#186490]">
                    <i class="fas fa-chart-bar"></i>
                </div>

                <div>

                    <h5 class="text-base font-bold text-slate-800 sm:text-lg">
                        Perkembangan Tinggi Badan
                    </h5>

                    <p class="mt-1 text-sm text-slate-500">
                        Perubahan tinggi badan anak berdasarkan pemeriksaan
                    </p>

                </div>

            </div>

            <div class="relative h-[300px] w-full sm:h-[350px]">
                <canvas id="grafikTinggi"></canvas>
            </div>

        </div>


        {{-- =====================================================
             RIWAYAT PEMERIKSAAN
        ====================================================== --}}

        <div class="mb-6 rounded-2xl border border-slate-100 bg-white shadow-sm">

            <div class="p-5 sm:p-6">

                <div class="mb-5 flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#eaf5fb] text-[#186490]">
                        <i class="fas fa-history"></i>
                    </div>

                    <div>

                        <h5 class="text-base font-bold text-slate-800 sm:text-lg">
                            Riwayat Pemeriksaan
                        </h5>

                        <p class="mt-1 text-sm text-slate-500">
                            Data hasil pemantauan gizi anak
                        </p>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full min-w-[750px] text-left text-sm">

                        <thead>

                            <tr class="border-b border-slate-200 text-xs uppercase tracking-wide text-[#186490]">

                                <th class="px-4 py-3 font-semibold">
                                    No
                                </th>

                                <th class="px-4 py-3 font-semibold">
                                    Tanggal
                                </th>

                                <th class="px-4 py-3 font-semibold">
                                    Umur
                                </th>

                                <th class="px-4 py-3 font-semibold">
                                    Berat
                                </th>

                                <th class="px-4 py-3 font-semibold">
                                    Tinggi
                                </th>

                                <th class="px-4 py-3 font-semibold">
                                    BMI
                                </th>

                                <th class="px-4 py-3 font-semibold">
                                    Status Gizi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse($riwayat->sortByDesc('created_at') as $index => $hasil)

                                @php

                                    $status = strtolower(
                                        $hasil->hasil_prediksi
                                    );

                                    if (str_contains($status, 'normal')) {

                                        $badge = 'bg-green-100 text-green-700';

                                    } elseif (str_contains($status, 'stunting')) {

                                        $badge = 'bg-amber-100 text-amber-700';

                                    } else {

                                        $badge = 'bg-red-100 text-red-700';

                                    }

                                @endphp


                                <tr class="transition hover:bg-slate-50">

                                    <td class="px-4 py-4 font-medium text-slate-600">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-slate-600">
                                        {{ $hasil->created_at->format('d/m/Y') }}
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-slate-600">
                                        {{ $hasil->dataAnak->umur_bulan }}
                                        bulan
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-slate-600">
                                        {{ number_format(
                                            $hasil->dataAnak->berat_badan,
                                            1
                                        ) }}
                                        kg
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-slate-600">
                                        {{ number_format(
                                            $hasil->dataAnak->tinggi_badan,
                                            1
                                        ) }}
                                        cm
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap font-medium text-slate-700">
                                        {{ number_format(
                                            $hasil->bmi,
                                            2
                                        ) }}
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap">

                                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-semibold {{ $badge }}">

                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                                            {{ $hasil->hasil_prediksi }}

                                        </span>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="px-4 py-10 text-center"
                                    >

                                        <div class="flex flex-col items-center">

                                            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                                                <i class="fas fa-history text-xl"></i>

                                            </div>

                                            <p class="mt-3 text-sm text-slate-500">
                                                Belum ada riwayat pemeriksaan.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | DATA DARI LARAVEL
    |--------------------------------------------------------------------------
    */

    const grafikData = @json($grafikData);


    /*
    |--------------------------------------------------------------------------
    | LABEL
    |--------------------------------------------------------------------------
    */

    const labels = grafikData.map(
        item => item.tanggal
    );


    /*
    |--------------------------------------------------------------------------
    | BERAT BADAN
    |--------------------------------------------------------------------------
    */

    const beratData = grafikData.map(
        item => item.berat
    );


    /*
    |--------------------------------------------------------------------------
    | TINGGI BADAN
    |--------------------------------------------------------------------------
    */

    const tinggiData = grafikData.map(
        item => item.tinggi
    );


    /*
    |--------------------------------------------------------------------------
    | GRAFIK BERAT BADAN
    |--------------------------------------------------------------------------
    */

    new Chart(
        document.getElementById('grafikBerat'),
        {

            type: 'line',

            data: {

                labels: labels,

                datasets: [

                    {

                        label: 'Berat Badan (kg)',

                        data: beratData,

                        borderWidth: 3,

                        pointRadius: 5,

                        pointHoverRadius: 7,

                        tension: 0.35,

                        fill: false

                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {

                    intersect: false,

                    mode: 'index'

                },

                plugins: {

                    legend: {

                        display: true

                    }

                },

                scales: {

                    y: {

                        title: {

                            display: true,

                            text: 'Berat Badan (kg)'

                        }

                    },

                    x: {

                        title: {

                            display: true,

                            text: 'Tanggal Pemeriksaan'

                        }

                    }

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | GRAFIK TINGGI BADAN
    |--------------------------------------------------------------------------
    */

    new Chart(
        document.getElementById('grafikTinggi'),
        {

            type: 'line',

            data: {

                labels: labels,

                datasets: [

                    {

                        label: 'Tinggi Badan (cm)',

                        data: tinggiData,

                        borderWidth: 3,

                        pointRadius: 5,

                        pointHoverRadius: 7,

                        tension: 0.35,

                        fill: false

                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {

                    intersect: false,

                    mode: 'index'

                },

                plugins: {

                    legend: {

                        display: true

                    }

                },

                scales: {

                    y: {

                        title: {

                            display: true,

                            text: 'Tinggi Badan (cm)'

                        }

                    },

                    x: {

                        title: {

                            display: true,

                            text: 'Tanggal Pemeriksaan'

                        }

                    }

                }

            }

        }
    );

</script>
@endsection
