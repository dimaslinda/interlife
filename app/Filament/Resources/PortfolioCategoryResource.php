<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioCategoryResource\Pages;
use App\Filament\Resources\PortfolioCategoryResource\RelationManagers;
use App\Models\PortfolioCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class PortfolioCategoryResource extends Resource
{
    protected static ?string $model = PortfolioCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?string $modelLabel = 'Kategori Portfolio';

    protected static ?string $pluralModelLabel = 'Kategori Portfolio';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kategori')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                                $set('filter_value', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash']),

                        Forms\Components\TextInput::make('filter_value')
                            ->label('Filter Value')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Nilai yang digunakan untuk filter JavaScript (contoh: kitchen-set, custom-furniture)'),
                    ])->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka yang lebih kecil akan ditampilkan lebih dulu'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('filter_value')
                    ->label('Filter Value')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('portfolios_count')
                    ->label('Jumlah Portfolio')
                    ->counts('portfolios')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Kategori portfolio berhasil dilihat')
                    ),
                Tables\Actions\EditAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Kategori portfolio berhasil diperbarui')
                    ),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Kategori portfolio berhasil dihapus')
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Kategori portfolio berhasil dihapus')
                        ),

                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => true]);
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Kategori portfolio berhasil diaktifkan')
                        ),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-circle')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => false]);
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Kategori portfolio berhasil dinonaktifkan')
                        ),
                ]),
            ])
            ->defaultSort('sort_order')
            ->emptyStateHeading('Belum ada kategori portfolio')
            ->emptyStateDescription('Mulai dengan membuat kategori portfolio pertama Anda.')
            ->emptyStateIcon('heroicon-o-folder');
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
            'index' => Pages\ListPortfolioCategories::route('/'),
            'create' => Pages\CreatePortfolioCategory::route('/create'),
            'edit' => Pages\EditPortfolioCategory::route('/{record}/edit'),
        ];
    }
}
