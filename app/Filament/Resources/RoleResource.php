<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\AdminAccessSetting;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;
    protected static ?string $navigationIcon  = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int    $navigationSort  = 2;

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
            Forms\Components\Section::make('Role Detail')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Role')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('key', Str::slug($state))),
                        
                    Forms\Components\TextInput::make('key')
                        ->label('Key / Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Digunakan secara internal (contoh: staff-marketing). Jangan diubah jika role sudah digunakan.'),
                        
                    Forms\Components\Toggle::make('has_admin_access')
                        ->label('Izinkan Akses Panel Admin?')
                        ->helperText('Jika diaktifkan, pengguna dengan role ini dapat masuk ke dashboard /admin.')
                        ->default(false),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Role')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => $record->key),
                    
                Tables\Columns\IconColumn::make('has_admin_access')
                    ->label('Akses Panel')
                    ->boolean()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([])
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit'   => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
