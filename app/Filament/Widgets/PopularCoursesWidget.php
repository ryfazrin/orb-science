<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PopularCoursesWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Katalog Kursus Terlaris (Paling Banyak Di-enroll)';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Course::query()
                    ->withCount('enrollments')
                    ->orderByDesc('enrollments_count')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Kursus')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('instructor.user.name')
                    ->label('Instruktur')
                    ->icon('heroicon-m-user-circle'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('enrollments_count')
                    ->label('Total Penjualan/Pendaftar')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-m-shopping-cart'),
            ])
            ->paginated(false);
    }
}
