<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ActiveCoursesWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Kursus Paling Sering Dipelajari (Hits Tertinggi)';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Course::query()
                    ->withCount(['lessons as completed_lessons_count' => function ($query) {
                        // Menghitung berapa banyak jejak penyelesaian (completed lessons) di tabel lesson_user
                        $query->has('users');
                    }])
                    ->orderByDesc('completed_lessons_count')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Kursus Aktif')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('difficulty')
                    ->label('Tingkat Kesulitan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Beginner' => 'success',
                        'Intermediate' => 'warning',
                        'Advanced' => 'danger',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('duration_hours')
                    ->label('Durasi Konten')
                    ->suffix(' Jam'),
                Tables\Columns\TextColumn::make('completed_lessons_count')
                    ->label('Hits Penyelesaian Terbanyak')
                    ->badge()
                    ->color('primary')
                    ->icon('heroicon-m-check-badge'),
            ])
            ->paginated(false);
    }
}
