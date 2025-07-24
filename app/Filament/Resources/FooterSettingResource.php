<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Filament\Resources\FooterSettingResource\RelationManagers;
use App\Models\FooterSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    
    protected static ?string $navigationGroup = 'Setting Website';
    
    protected static ?string $navigationLabel = 'Footer Settings';
    
    protected static ?string $modelLabel = 'Footer Setting';
    
    protected static ?string $pluralModelLabel = 'Footer Settings';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pengaturan Footer')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Footer')
                            ->required()
                            ->maxLength(255)
                            ->default('Wujudkan Hunian Impian Anda!')
                            ->helperText('Teks yang akan ditampilkan di bagian kiri footer'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])->columns(2),
                
                Forms\Components\Section::make('Tombol Call-to-Action')
                    ->schema([
                        Forms\Components\TextInput::make('button_text')
                            ->label('Teks Tombol')
                            ->required()
                            ->maxLength(255)
                            ->default('Konsultasi Gratis Sekarang')
                            ->helperText('Teks yang akan ditampilkan pada tombol'),
                        
                        Forms\Components\TextInput::make('button_url')
                            ->label('URL Tombol')
                            ->required()
                            ->url()
                            ->default('https://wa.me/+6285770622336')
                            ->helperText('Link yang akan dibuka ketika tombol diklik (contoh: WhatsApp, Telegram, dll)'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Table tidak digunakan karena langsung ke form
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFooterSettings::route('/'),
        ];
    }
}
