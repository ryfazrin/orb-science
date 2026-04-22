<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PathwayResource\Pages;
use App\Filament\Resources\PathwayResource\RelationManagers;
use App\Models\AdminAccessSetting;
use App\Models\Pathway;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PathwayResource extends Resource
{
    protected static ?string $model = Pathway::class;
    protected static ?string $navigationIcon  = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Learning Paths';
    protected static ?string $navigationGroup = 'Learning Paths';
    protected static ?int    $navigationSort  = 1;

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        if ($user->isAdmin()) return true;
        return AdminAccessSetting::isVisible(static::class, $user->role);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Nama Jalur Karir')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
            Forms\Components\TextInput::make('slug')
                ->label('Slug (URL)')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->rows(3)
                ->columnSpanFull(),
            Forms\Components\TextInput::make('icon')
                ->label('Nama Ikon (Lucide)')
                ->placeholder('cth: code, terminal, brain')
                ->helperText('Lihat daftar di lucide.dev'),
            Forms\Components\ColorPicker::make('color')
                ->label('Warna Tema'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ColorColumn::make('color')->label('Warna'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('URL Slug'),
                Tables\Columns\TextColumn::make('levels_count')
                    ->counts('levels')
                    ->label('Jumlah Level')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LevelsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPathways::route('/'),
            'create' => Pages\CreatePathway::route('/create'),
            'edit'   => Pages\EditPathway::route('/{record}/edit'),
        ];
    }
}
