<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Notifications\Notification;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    
    protected static ?string $navigationGroup = 'Konten Website';
    
    protected static ?string $navigationLabel = 'Layanan';
    
    protected static ?string $modelLabel = 'Layanan';
    
    protected static ?string $pluralModelLabel = 'Layanan';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Layanan')
                    ->description('Kelola informasi dasar layanan')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Layanan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Kitchen Set')
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->placeholder('Deskripsi singkat tentang layanan ini')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Media')
                    ->description('Upload gambar untuk layanan')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Gambar Layanan')
                            ->collection('default')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->required()
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Tombol Aksi')
                    ->description('Konfigurasi tombol konsultasi')
                    ->schema([
                        Forms\Components\TextInput::make('button_text')
                            ->label('Teks Tombol')
                            ->default('Konsultasikan')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('button_url')
                            ->label('URL Tombol')
                            ->default('https://wa.me/+6285770622336')
                            ->required()
                            ->url()
                            ->placeholder('https://wa.me/+6285770622336'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Pengaturan')
                    ->description('Pengaturan tampilan dan urutan')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil akan tampil lebih dulu'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Layanan yang tidak aktif tidak akan ditampilkan di website'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Gambar')
                    ->collection('default')
                    ->conversion('thumb')
                    ->size(60)
                    ->circular(),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->tooltip(fn ($record) => $record->description),
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->description)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('button_text')
                    ->label('Teks Tombol')
                    ->badge()
                    ->color('primary'),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua layanan')
                    ->trueLabel('Hanya yang aktif')
                    ->falseLabel('Hanya yang tidak aktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Layanan Dihapus! 🗑️')
                            ->body('Layanan berhasil dihapus dari sistem.')
                            ->duration(5000)
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Layanan Dihapus! 🗑️')
                                ->body('Layanan yang dipilih berhasil dihapus.')
                                ->duration(5000)
                        ),
                    
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => true]);
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Layanan Diaktifkan! ✅')
                                ->body('Layanan yang dipilih berhasil diaktifkan.')
                                ->duration(5000)
                        ),
                    
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => false]);
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Layanan Dinonaktifkan! ❌')
                                ->body('Layanan yang dipilih berhasil dinonaktifkan.')
                                ->duration(5000)
                        ),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->emptyStateHeading('Belum ada layanan')
            ->emptyStateDescription('Mulai dengan membuat layanan pertama untuk website Anda.')
            ->emptyStateIcon('heroicon-o-wrench-screwdriver');
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
