<?php

namespace App\Filament\Resources\PathwayResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LevelsRelationManager extends RelationManager
{
    protected static string $relationship = 'levels';
    protected static ?string $title = 'Level Jalur';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Nama Level')
                ->placeholder('cth: Pemula, Menengah, Mahir')
                ->required(),
            Forms\Components\Textarea::make('description')
                ->label('Deskripsi Level')
                ->rows(2),
            Forms\Components\TextInput::make('order')
                ->label('Urutan')
                ->numeric()
                ->default(0),
            Forms\Components\Select::make('courses')
                ->label('Kursus dalam Level Ini')
                ->relationship('courses', 'title')
                ->multiple()
                ->preload()
                ->searchable()
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('title')->label('Level'),
                Tables\Columns\TextColumn::make('courses_count')
                    ->counts('courses')
                    ->label('Kursus')
                    ->badge()
                    ->color('success'),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }
}
