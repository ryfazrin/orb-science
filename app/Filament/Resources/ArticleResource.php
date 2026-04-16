<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Artikel')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Artikel')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state)))
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\Select::make('category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name')
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\ColorPicker::make('color'),
                        ])
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('tags')
                        ->label('Tag')
                        ->relationship('tags', 'name')
                        ->multiple()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->required(),
                        ])
                        ->searchable()
                        ->preload(),
                    Forms\Components\Textarea::make('excerpt')
                        ->label('Ringkasan / Excerpt')
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make('Konten')
                ->schema([
                    Forms\Components\Tabs::make('Editor')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make('Editor Mode')
                                ->schema([
                                    Forms\Components\MarkdownEditor::make('content')
                                        ->hiddenLabel()
                                        ->fileAttachmentsDirectory('articles')
                                        ->live(debounce: 500),
                                ]),
                            Forms\Components\Tabs\Tab::make('Live Preview')
                                ->schema([
                                    Forms\Components\Placeholder::make('preview')
                                        ->hiddenLabel()
                                        ->content(fn ($get) => new \Illuminate\Support\HtmlString(
                                            view('filament.components.markdown-preview', ['content' => $get('content')])->render()
                                        )),
                                ]),
                        ])
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Penerbitan')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('article-thumbnails')
                        ->imagePreviewHeight('200')
                        ->columnSpanFull(),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'draft'     => 'Draft',
                            'published' => 'Published',
                        ])
                        ->default('draft')
                        ->live()
                        ->required(),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Tanggal Publish')
                        ->visible(fn ($get) => $get('status') === 'published')
                        ->default(now()),
                    Forms\Components\Select::make('user_id')
                        ->label('Penulis')
                        ->relationship('author', 'name')
                        ->searchable()
                        ->preload()
                        ->default(fn () => auth()->id()),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('')
                    ->square()
                    ->rounded(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ]),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publish')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published']),
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit'   => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
