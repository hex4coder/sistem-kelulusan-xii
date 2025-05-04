<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Kelulusan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JumlahTidakLulus extends BaseWidget
{
    protected function getStats(): array
    {

        $jumlahTidakLulus = Kelulusan::where('lulus', false)->count();
        return [
            //
            Stat::make('Jumlah Siswa yang Lulus', $jumlahTidakLulus)
                ->description('Jumlah Siswa yang tidak lulus')
                ->icon('heroicon-o-x-mark')
            ->color('danger'),
        ];
    }
}
