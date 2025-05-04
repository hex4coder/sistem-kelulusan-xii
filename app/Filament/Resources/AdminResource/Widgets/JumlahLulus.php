<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Kelulusan;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JumlahLulus extends BaseWidget
{
    protected function getStats(): array
    {
        $jumlahLulus = Kelulusan::where('lulus', true)->count();
        return [
            //
            Stat::make('Jumlah Siswa yang Lulus', $jumlahLulus)
                ->description('Jumlah Siswa yang lulus')
                ->icon('heroicon-o-check')
            ->color('success'),
        ];
    }
}
