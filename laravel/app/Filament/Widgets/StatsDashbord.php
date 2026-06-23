<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Artikel;
use App\Models\DataAnak;
use App\Models\Video;
use App\Models\User;

class StatsDashbord extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Artikel::count())
                ->description('Jumlah artikel yang tersedia')
                ->icon('heroicon-o-newspaper'),

            Stat::make('Total Video', Video::count())
                ->description('Jumlah video edukasi')
                ->icon('heroicon-o-video-camera'),

            Stat::make('Data Anak', DataAnak::count())
                ->description('Jumlah data anak terdaftar')
                ->icon('heroicon-o-user-group'),

            Stat::make('Total User', User::count())
                ->description('Jumlah pengguna sistem')
                ->icon('heroicon-o-users'),
        ];
    }
}