<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationLabel = 'Banner';
    
    protected static ?string $modelLabel = 'Banner';
    
    protected static ?string $pluralModelLabel = 'Banner';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $navigationGroup = 'Konten Website';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konten Banner')
                    ->description('Atur konten utama banner yang akan ditampilkan')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Banner')
                            ->placeholder('Masukkan judul banner yang menarik')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('subtitle')
                            ->label('Subjudul Banner')
                            ->placeholder('Masukkan deskripsi atau subjudul banner')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('background_image')
                            ->label('Gambar Latar Belakang')
                            ->helperText('Upload gambar dengan resolusi minimal 1920x1080px untuk hasil terbaik')
                            ->collection('banners')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '21:9',
                            ])
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),
                
                Forms\Components\Section::make('Tombol Aksi')
                    ->description('Konfigurasi tombol-tombol yang akan ditampilkan di banner')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('primary_button_text')
                                    ->label('Teks Tombol Utama')
                                    ->placeholder('Contoh: Konsultasi Gratis')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('primary_button_url')
                                    ->label('URL Tombol Utama')
                                    ->placeholder('https://wa.me/+6285770622336')
                                    ->required()
                                    ->url()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('secondary_button_text')
                                    ->label('Teks Tombol Kedua')
                                    ->placeholder('Contoh: Lihat Portofolio')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('secondary_button_url')
                                    ->label('URL Tombol Kedua')
                                    ->placeholder('#portofolio atau URL lainnya')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ])
                    ->collapsible(),
                
                Forms\Components\Section::make('Pengaturan')
                    ->description('Pengaturan status dan visibilitas banner')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktifkan Banner')
                            ->helperText('Hanya banner yang aktif yang akan ditampilkan di website')
                            ->default(true)
                            ->required(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('background_image')
                    ->label('Gambar')
                    ->collection('banners')
                    ->height(60)
                    ->width(100)
                    ->circular(false),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Banner')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subjudul')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->wrap(),
                Tables\Columns\TextColumn::make('primary_button_text')
                    ->label('Tombol Utama')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('secondary_button_text')
                    ->label('Tombol Kedua')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Banner')
                    ->placeholder('Semua Banner')
                    ->trueLabel('Banner Aktif')
                    ->falseLabel('Banner Tidak Aktif')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\Action::make('toggle_status')
                    ->label(fn ($record) => $record->is_active ? 'Nonaktifkan' : 'Aktifkan')
                    ->icon(fn ($record) => $record->is_active ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn ($record) => $record->is_active ? 'warning' : 'success')
                    ->action(function ($record) {
                        $record->update(['is_active' => !$record->is_active]);
                    })
                    ->successNotification(function ($record) {
                        return \Filament\Notifications\Notification::make()
                            ->success()
                            ->title($record->is_active ? 'Banner Diaktifkan! 👁️' : 'Banner Dinonaktifkan! 🙈')
                            ->body($record->is_active 
                                ? 'Banner sekarang aktif dan akan ditampilkan di website.' 
                                : 'Banner telah dinonaktifkan dan tidak akan ditampilkan di website.')
                            ->duration(4000)
                            ->icon($record->is_active ? 'heroicon-o-eye' : 'heroicon-o-eye-slash');
                    })
                    ->requiresConfirmation()
                    ->modalHeading(fn ($record) => $record->is_active ? 'Nonaktifkan Banner' : 'Aktifkan Banner')
                    ->modalDescription(fn ($record) => $record->is_active 
                        ? 'Apakah Anda yakin ingin menonaktifkan banner ini?' 
                        : 'Apakah Anda yakin ingin mengaktifkan banner ini?'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->successNotification(
                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Banner Berhasil Dihapus! 🗑️')
                                ->body('Banner yang dipilih telah berhasil dihapus dari sistem.')
                                ->duration(5000)
                                ->icon('heroicon-o-trash')
                        ),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan Terpilih')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['is_active' => true]));
                        })
                        ->successNotification(
                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Banner Berhasil Diaktifkan! 👁️')
                                ->body('Semua banner yang dipilih telah berhasil diaktifkan.')
                                ->duration(4000)
                                ->icon('heroicon-o-eye')
                        )
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan Terpilih')
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['is_active' => false]));
                        })
                        ->successNotification(
                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Banner Berhasil Dinonaktifkan! 🙈')
                                ->body('Semua banner yang dipilih telah berhasil dinonaktifkan.')
                                ->duration(4000)
                                ->icon('heroicon-o-eye-slash')
                        )
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('Belum ada banner')
            ->emptyStateDescription('Mulai dengan membuat banner pertama Anda.')
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
