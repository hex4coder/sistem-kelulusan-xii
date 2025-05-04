<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JumlahSiswa extends BaseWidget
{
    protected function getStats(): array
    {

        $jumlahSiswa = Student::all()->count();

        return [
            //
            Stat::make('Total Siswa', $jumlahSiswa)
                ->description('Jumlah keseluruhan siswa terdaftar')
            ->icon('heroicon-o-user-group')
            ->color('primary'),
        ];
    }
}
