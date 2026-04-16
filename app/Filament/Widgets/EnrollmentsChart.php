<?php

namespace App\Filament\Widgets;

use App\Models\Enrollment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class EnrollmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pertumbuhan Pendaftar';
    protected static ?int $sort = 2; // Tampil di bawah StatsOverview
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $year = Carbon::now()->year;
        
        // Menjemput data setahun terakhir dan mengelompokkannya per bulan via Collection
        // (Metode ini paling aman dan kompatibel untuk MySQL/MariaDB/PostgreSQL/SQLite)
        $enrollments = Enrollment::select('created_at')
            ->whereYear('created_at', $year)
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('n');
            });

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = isset($enrollments[$i]) ? $enrollments[$i]->count() : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Siswa Mendaftar (' . $year . ')',
                    'data' => $data,
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)', // Blue tailwind
                    'borderColor' => 'rgb(59, 130, 246)',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
