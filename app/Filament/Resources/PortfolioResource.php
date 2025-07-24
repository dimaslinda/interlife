<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?string $modelLabel = 'Portfolio';

    protected static ?string $pluralModelLabel = 'Portfolio';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Portfolio')
                    ->schema([
                        Forms\Components\Select::make('portfolio_category_id')
                            ->label('Kategori Portfolio')
                            ->relationship('portfolioCategory', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('title')
                            ->label('Judul Portfolio')
                            ->required()
                            ->maxLength(255),


                    ])->columns(2),

                Forms\Components\Section::make('Media')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('images')
                            ->label('Gambar Portfolio')
                            ->multiple()
                            ->collection('portfolio_images')
                            ->reorderable()
                            ->image()
                            ->imageEditor()
                            ->maxFiles(10)
                            ->helperText('Upload maksimal 10 gambar untuk portfolio ini'),
                    ]),

                Forms\Components\Section::make('Detail Spesifikasi')
                    ->schema([
                        Forms\Components\TextInput::make('design_style')
                            ->label('Gaya Desain')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('frame_material')
                            ->label('Bahan Rangka')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('finishing')
                            ->label('Finishing')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('rating')
                            ->label('Rating')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->step(0.1)
                            ->default(5.0)
                            ->suffix('/ 5'),
                    ])->columns(2),

                Forms\Components\Section::make('Testimoni')
                    ->schema([
                        Forms\Components\Textarea::make('testimonial')
                            ->label('Testimoni Client')
                            ->rows(4)
                            ->helperText('Testimoni dari client untuk portfolio ini'),
                    ]),

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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('images')
                    ->label('Gambar')
                    ->collection('portfolio_images')
                    ->conversion('thumb')
                    ->size(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('portfolioCategory.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge(),



                Tables\Columns\TextColumn::make('design_style')
                    ->label('Gaya Desain')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state . '/5')
                    ->badge()
                    ->color('success'),

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
                Tables\Filters\SelectFilter::make('portfolio_category_id')
                    ->label('Kategori')
                    ->relationship('portfolioCategory', 'name')
                    ->searchable()
                    ->preload(),

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
                            ->title('Portfolio berhasil dilihat')
                    ),
                Tables\Actions\EditAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Portfolio berhasil diperbarui')
                    ),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Portfolio berhasil dihapus')
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Portfolio berhasil dihapus')
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
                                ->title('Portfolio berhasil diaktifkan')
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
                                ->title('Portfolio berhasil dinonaktifkan')
                        ),
                ]),
            ])
            ->defaultSort('sort_order')
            ->emptyStateHeading('Belum ada portfolio')
            ->emptyStateDescription('Mulai dengan membuat portfolio pertama Anda.')
            ->emptyStateIcon('heroicon-o-photo');
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
