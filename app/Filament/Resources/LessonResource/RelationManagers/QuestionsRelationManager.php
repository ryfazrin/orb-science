<?php

namespace App\Filament\Resources\LessonResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\MarkdownEditor::make('question_text')
                    ->label('Teks Pertanyaan')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('points')
                    ->label('Nilai Poin')
                    ->numeric()
                    ->default(10)
                    ->required(),
                Forms\Components\Repeater::make('options')
                    ->relationship('options')
                    ->label('Pilihan Ganda')
                    ->schema([
                        Forms\Components\TextInput::make('option_text')
                            ->label('Teks Pilihan (A/B/C/D)')
                            ->required(),
                        Forms\Components\Toggle::make('is_correct')
                            ->label('Atur sebagai Jawaban Benar')
                            ->onColor('success'),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                Tables\Columns\TextColumn::make('question_text')
                    ->label('Materi Soal')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('points')
                    ->label('Poin Soal')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('options_count')
                    ->counts('options')
                    ->label('Jumlah Opsi')
                    ->badge()
                    ->color('info'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
