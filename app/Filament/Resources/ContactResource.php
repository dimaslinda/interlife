<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationGroup = 'Setting Website';

    protected static ?string $modelLabel = 'Kontak';

    protected static ?string $pluralModelLabel = 'Kontak';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Tipe Kontak')
                            ->required()
                            ->options([
                                'phone' => 'Telepon',
                                'email' => 'Email',
                                'instagram' => 'Instagram',
                                'address' => 'Alamat',
                            ])
                            ->placeholder('Pilih tipe kontak'),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->placeholder('0'),
                    ]),

                Forms\Components\TextInput::make('label')
                    ->label('Label')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Telepon, Email, Instagram, Alamat')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('value')
                    ->label('Nilai Kontak')
                    ->required()
                    ->rows(3)
                    ->placeholder('Contoh: 0857-7062-2336, email@domain.com, @username, alamat lengkap')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('icon')
                    ->label('Icon SVG')
                    ->required()
                    ->rows(5)
                    ->placeholder('Paste SVG icon code here')
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'phone' => 'success',
                        'email' => 'info',
                        'instagram' => 'warning',
                        'address' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'phone' => 'Telepon',
                        'email' => 'Email',
                        'instagram' => 'Instagram',
                        'address' => 'Alamat',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->label('Label')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueLabel('Hanya yang aktif')
                    ->falseLabel('Hanya yang tidak aktif')
                    ->native(false),

                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe Kontak')
                    ->options([
                        'phone' => 'Telepon',
                        'email' => 'Email',
                        'instagram' => 'Instagram',
                        'address' => 'Alamat',
                    ])
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->successNotification(
                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Kontak berhasil diperbarui')
                            ->body('Data kontak telah diperbarui dengan sukses.')
                            ->duration(5000)
                            ->icon('heroicon-o-pencil-square')
                    ),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->successNotification(
                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Kontak berhasil dihapus')
                            ->body('Data kontak telah dihapus dari sistem.')
                            ->duration(5000)
                            ->icon('heroicon-o-trash')
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Kontak berhasil dihapus')
                                ->body('Data kontak yang dipilih telah dihapus dari sistem.')
                                ->duration(5000)
                                ->icon('heroicon-o-trash')
                        ),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
