<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('module_id')
                    ->relationship('module', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'video' => 'Video',
                        'article' => 'Text/Article',
                        'quiz' => 'Quiz'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('duration_minutes')
                    ->required()
                    ->numeric(),
                Forms\Components\Tabs::make('Content Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Editor Mode')
                            ->schema([
                                Forms\Components\MarkdownEditor::make('content')
                                    ->fileAttachmentsDirectory('lessons')
                                    ->live(debounce: 500)
                                    ->hiddenLabel()
                            ]),
                        Forms\Components\Tabs\Tab::make('Live Preview (Hasil)')
                            ->schema([
                                Forms\Components\Placeholder::make('preview')
                                    ->hiddenLabel()
                                    ->content(fn ($get) => new \Illuminate\Support\HtmlString(
                                        view('filament.components.markdown-preview', ['content' => $get('content')])->render()
                                    ))
                            ])
                    ])
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_free_preview')
                    ->required(),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('duration_minutes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_free_preview')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
