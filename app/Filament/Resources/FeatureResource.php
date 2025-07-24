<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource\RelationManagers;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    
    protected static ?string $navigationLabel = 'Fitur';
    
    protected static ?string $modelLabel = 'Fitur';
    
    protected static ?string $pluralModelLabel = 'Fitur';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $navigationGroup = 'Konten Website';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Fitur')
                    ->description('Atur informasi fitur yang akan ditampilkan di website')
                    ->schema([
                        Forms\Components\Textarea::make('icon')
                            ->label('Kode Icon (SVG)')
                            ->placeholder('Masukkan kode SVG icon untuk fitur ini')
                            ->helperText('Gunakan kode SVG lengkap atau class icon dari library seperti Heroicons')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Fitur')
                            ->placeholder('Masukkan judul fitur yang menarik')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Fitur')
                            ->placeholder('Jelaskan detail fitur ini dengan menarik')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Fitur')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(80)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 80) {
                            return null;
                        }
                        return $state;
                    })
                    ->wrap(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->limit(30)
                    ->badge()
                    ->color('gray')
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        return 'Klik edit untuk melihat kode lengkap';
                    }),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->successNotification(
                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Fitur Berhasil Dihapus! 🗑️')
                            ->body('Fitur telah berhasil dihapus dari sistem.')
                            ->duration(5000)
                            ->icon('heroicon-o-trash')
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->successNotification(
                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Fitur Berhasil Dihapus! 🗑️')
                                ->body('Fitur yang dipilih telah berhasil dihapus dari sistem.')
                                ->duration(5000)
                                ->icon('heroicon-o-trash')
                        ),
                ]),
            ])
            ->emptyStateHeading('Belum ada fitur')
            ->emptyStateDescription('Mulai dengan membuat fitur pertama untuk website Anda.')
            ->emptyStateIcon('heroicon-o-star');
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
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
