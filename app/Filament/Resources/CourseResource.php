<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('instructor_id')
                    ->options(\App\Models\Instructor::with('user')->get()->pluck('user.name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('$'),
                Forms\Components\TextInput::make('thumbnail_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('category')
                    ->maxLength(255),
                Forms\Components\Select::make('difficulty')
                    ->options([
                        'Beginner' => 'Beginner',
                        'Intermediate' => 'Intermediate',
                        'Advanced' => 'Advanced'
                    ]),
                Forms\Components\TextInput::make('language')
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration_hours')
                    ->numeric(),
                Forms\Components\Toggle::make('is_bestseller')
                    ->required(),
                Forms\Components\Toggle::make('certificate_included')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('instructor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('thumbnail_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('difficulty')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_bestseller')
                    ->boolean(),
                Tables\Columns\IconColumn::make('certificate_included')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
