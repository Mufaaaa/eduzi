@extends('layout.app')

@section('title', 'Grafik Perkembangan Gizi')

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

                <h2 class="flex items-center gap-2 text-2xl font-bold tracking-tight text-[#1f3b2f] sm:text-3xl">
                    <i class="fas fa-chart-line text-xl text-[#49a35a] sm:text-2xl"></i>
                    Grafik Perkembangan Gizi
                </h2>

                <p class="mt-1 text-sm text-[#708277]">
                    Perkembangan pertumbuhan anak berdasarkan riwayat pemeriksaan
                </p>
            </div>

            <a
                href="{{ route('pemantauan', ['anak' => $anak->id]) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#dfe6dc] bg-white px-5 py-3 text-sm font-semibold text-[#334d40] shadow-sm transition hover:bg-[#e8f4ea] hover:text-[#3f8e4e]"
            >
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- INFORMASI ANAK --}}
        <div class="relative mb-6 overflow-hidden rounded-2xl bg-gradient-to-br from-[#49a35a] to-[#287d3c] text-white shadow-sm">

            {{-- Dekorasi --}}
            <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-20 right-20 h-32 w-32 rounded-full bg-white/5"></div>

            <div class="relative p-6 sm:p-7">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center">
                        <div class="mr-4 flex h-16 w-16 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/15">
                            <i class="fas fa-child text-2xl"></i>
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

                    <div class="rounded-xl border border-white/10 bg-white/10 px-5 py-3 sm:text-right">
                        <div class="text-2xl font-bold">
                            {{ $riwayat->count() }}
                        </div>

                        <div class="text-xs text-white/80">
                            Kali Pemeriksaan
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- GRAFIK BERAT BADAN --}}
        <div class="mb-6 rounded-2xl border border-[#e5ebdf] bg-white p-5 shadow-sm sm:p-6">

            <div class="mb-5 flex items-start gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                    <i class="fas fa-chart-line"></i>
                </div>

                <div>
                    <h5 class="text-base font-bold text-[#1f3b2f] sm:text-lg">
                        Perkembangan Berat Badan
                    </h5>

                    <p class="mt-1 text-sm text-[#708277]">
                        Perubahan berat badan anak berdasarkan pemeriksaan
                    </p>
                </div>
            </div>

            <div class="relative h-[300px] w-full sm:h-[350px]">
                <canvas id="grafikBerat"></canvas>
            </div>
        </div>

        {{-- GRAFIK TINGGI BADAN --}}
        <div class="mb-6 rounded-2xl border border-[#e5ebdf] bg-white p-5 shadow-sm sm:p-6">

            <div class="mb-5 flex items-start gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                    <i class="fas fa-chart-bar"></i>
                </div>

                <div>
                    <h5 class="text-base font-bold text-[#1f3b2f] sm:text-lg">
                        Perkembangan Tinggi Badan
                    </h5>

                    <p class="mt-1 text-sm text-[#708277]">
                        Perubahan tinggi badan anak berdasarkan pemeriksaan
                    </p>
                </div>
            </div>

            <div class="relative h-[300px] w-full sm:h-[350px]">
                <canvas id="grafikTinggi"></canvas>
            </div>
        </div>

        {{-- RIWAYAT PEMERIKSAAN --}}
        <div class="mb-6 rounded-2xl border border-[#e5ebdf] bg-white shadow-sm">

            <div class="p-5 sm:p-6">

                <div class="mb-5 flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#e8f4ea] text-[#49a35a]">
                        <i class="fas fa-history"></i>
                    </div>

                    <div>
                        <h5 class="text-base font-bold text-[#1f3b2f] sm:text-lg">
                            Riwayat Pemeriksaan
                        </h5>

                        <p class="mt-1 text-sm text-[#708277]">
                            Data hasil pemantauan gizi anak
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[750px] text-left text-sm">

                        <thead>
                            <tr class="border-b border-[#e5ebdf] text-xs uppercase tracking-wide text-[#3f8e4e]">
                                <th class="px-4 py-3 font-semibold">No</th>
                                <th class="px-4 py-3 font-semibold">Tanggal</th>
                                <th class="px-4 py-3 font-semibold">Umur</th>
                                <th class="px-4 py-3 font-semibold">Berat</th>
                                <th class="px-4 py-3 font-semibold">Tinggi</th>
                                <th class="px-4 py-3 font-semibold">BMI</th>
                                <th class="px-4 py-3 font-semibold">Status Gizi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#edf1e9]">
                            @forelse($riwayat->sortByDesc('created_at') as $index => $hasil)

                                @php
                                    $status = strtolower($hasil->hasil_prediksi);

                                    if (str_contains($status, 'normal')) {
                                        $badge = 'bg-green-100 text-green-700';
                                    } elseif (str_contains($status, 'stunting')) {
                                        $badge = 'bg-amber-100 text-amber-700';
                                    } else {
                                        $badge = 'bg-red-100 text-red-700';
                                    }
                                @endphp

                                <tr class="transition hover:bg-[#f6f8f3]">

                                    <td class="px-4 py-4 font-medium text-slate-600">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-slate-600">
                                        {{ $hasil->created_at->format('d/m/Y') }}
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-slate-600">
                                        {{ $hasil->dataAnak->umur_bulan }} bulan
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-slate-600">
                                        {{ number_format($hasil->dataAnak->berat_badan, 1) }} kg
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 text-slate-600">
                                        {{ number_format($hasil->dataAnak->tinggi_badan, 1) }} cm
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4 font-medium text-slate-700">
                                        {{ number_format($hasil->bmi, 2) }}
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-4">
                                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-semibold {{ $badge }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            {{ $hasil->hasil_prediksi }}
                                        </span>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="px-4 py-10 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#e8f4ea] text-[#49a35a]">
                                                <i class="fas fa-history text-xl"></i>
                                            </div>

                                            <p class="mt-3 text-sm text-[#708277]">
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

        {{-- CATATAN --}}
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-[#e5ebdf] bg-white p-4">
            <i class="fas fa-info-circle mt-0.5 text-[#49a35a]"></i>
            <p class="text-xs leading-6 text-[#708277]">
                Grafik ini membantu orang tua memantau perubahan berat dan tinggi badan anak dari waktu ke waktu. Interpretasi status gizi anak perlu mempertimbangkan umur, jenis kelamin, serta standar antropometri yang sesuai. Konsultasikan hasil pemantauan kepada tenaga kesehatan.
            </p>
        </div>

    </div>
</div>

{{-- JAVASCRIPT GRAFIK --}}
<script>
    const grafikData = @json($grafikData);

    const labels = grafikData.map(item => item.tanggal);
    const beratData = grafikData.map(item => item.berat);
    const tinggiData = grafikData.map(item => item.tinggi);

    // Konfigurasi umum grafik
    const opsiGrafik = {
        responsive: true,
        maintainAspectRatio: false,

        interaction: {
            intersect: false,
            mode: 'index'
        },

        plugins: {
            legend: {
                display: true,
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            },

            tooltip: {
                backgroundColor: '#1f3b2f',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                padding: 12,
                cornerRadius: 8
            }
        },

        scales: {
            y: {
                beginAtZero: false,
                grid: {
                    color: '#edf1e9'
                },
                ticks: {
                    color: '#708277'
                }
            },

            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#708277'
                }
            }
        }
    };

    // Grafik berat badan
    new Chart(document.getElementById('grafikBerat'), {
        type: 'line',

        data: {
            labels: labels,

            datasets: [{
                label: 'Berat Badan (kg)',
                data: beratData,

                borderColor: '#49a35a',
                backgroundColor: 'rgba(73, 163, 90, 0.12)',

                borderWidth: 3,
                pointRadius: 4,
                pointHoverRadius: 7,

                pointBackgroundColor: '#49a35a',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,

                tension: 0.35,
                fill: true
            }]
        },

        options: {
            ...opsiGrafik,

            scales: {
                ...opsiGrafik.scales,

                y: {
                    ...opsiGrafik.scales.y,

                    title: {
                        display: true,
                        text: 'Berat Badan (kg)',
                        color: '#334d40'
                    }
                },

                x: {
                    ...opsiGrafik.scales.x,

                    title: {
                        display: true,
                        text: 'Tanggal Pemeriksaan',
                        color: '#334d40'
                    }
                }
            }
        }
    });

    // Grafik tinggi badan
    new Chart(document.getElementById('grafikTinggi'), {
        type: 'line',

        data: {
            labels: labels,

            datasets: [{
                label: 'Tinggi Badan (cm)',
                data: tinggiData,

                borderColor: '#287d3c',
                backgroundColor: 'rgba(40, 125, 60, 0.12)',

                borderWidth: 3,
                pointRadius: 4,
                pointHoverRadius: 7,

                pointBackgroundColor: '#287d3c',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,

                tension: 0.35,
                fill: true
            }]
        },

        options: {
            ...opsiGrafik,

            scales: {
                ...opsiGrafik.scales,

                y: {
                    ...opsiGrafik.scales.y,

                    title: {
                        display: true,
                        text: 'Tinggi Badan (cm)',
                        color: '#334d40'
                    }
                },

                x: {
                    ...opsiGrafik.scales.x,

                    title: {
                        display: true,
                        text: 'Tanggal Pemeriksaan',
                        color: '#334d40'
                    }
                }
            }
        }
    });
</script>

@endsection
