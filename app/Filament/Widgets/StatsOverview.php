<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    // Supaya widget diproses di atas chart
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalStudents = User::whereHas('role', function ($query) {
            $query->where('key', 'student');
        })->count();
        $totalCourses = Course::count();
        
        // Perkiraan Revenue (Menjumlahkan harga kursus dari semua pendaftar)
        // Jika database scale puluhan ribu, gunakan DB raw sum. Saat ini kita gunakan iterasi atau DB join:
        $totalRevenue = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.price');

        return [
            Stat::make('Total Siswa', $totalStudents)
                ->description('Pengguna terdaftar belajar')
                ->descriptionIcon('heroicon-m-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
                
            Stat::make('Total Kursus', $totalCourses)
                ->description('Materi aktif platform')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),
                
            Stat::make('Estimasi Penjualan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total penjualan kumulatif')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([2, 5, 4, 8, 12, 10, 15])
                ->color('success'),
        ];
    }
}
