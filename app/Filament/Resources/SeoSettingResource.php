<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoSettingResource\Pages;
use App\Filament\Resources\SeoSettingResource\RelationManagers;
use App\Models\SeoSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeoSettingResource extends Resource
{
    protected static ?string $model = SeoSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationGroup = 'Setting Website';
    
    protected static ?string $navigationLabel = 'SEO Settings';
    
    protected static ?string $modelLabel = 'SEO Setting';
    
    protected static ?string $pluralModelLabel = 'SEO Settings';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Halaman')
                    ->schema([
                        Forms\Components\TextInput::make('page_name')
                            ->label('Nama Halaman')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('home, about, contact, dll')
                            ->helperText('Nama unik untuk halaman (contoh: home, about, contact)'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])->columns(2),
                
                Forms\Components\Section::make('Meta Tags Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(80)
                            ->helperText('Maksimal 80 karakter untuk SEO optimal'),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->maxLength(200)
                            ->rows(3)
                            ->helperText('Maksimal 200 karakter untuk SEO optimal'),
                        
                        Forms\Components\Textarea::make('keywords')
                            ->label('Keywords')
                            ->rows(2)
                            ->helperText('Pisahkan dengan koma (,)'),
                        
                        Forms\Components\TextInput::make('author')
                            ->label('Author'),
                        
                        Forms\Components\Select::make('robots')
                            ->label('Robots')
                            ->options([
                                'index, follow' => 'Index, Follow',
                                'noindex, nofollow' => 'No Index, No Follow',
                                'index, nofollow' => 'Index, No Follow',
                                'noindex, follow' => 'No Index, Follow',
                            ])
                            ->default('index, follow'),
                        
                        Forms\Components\TextInput::make('language')
                            ->label('Language')
                            ->default('Indonesia'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Geographic & Theme')
                    ->schema([
                        Forms\Components\TextInput::make('geo_region')
                            ->label('Geo Region')
                            ->placeholder('ID-JK'),
                        
                        Forms\Components\TextInput::make('geo_placename')
                            ->label('Geo Place Name')
                            ->placeholder('Jakarta'),
                        
                        Forms\Components\ColorPicker::make('theme_color')
                            ->label('Theme Color')
                            ->placeholder('#7a8b66'),
                        
                        Forms\Components\TextInput::make('revisit_after')
                            ->label('Revisit After')
                            ->default('7 days'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Open Graph (Facebook)')
                    ->schema([
                        Forms\Components\TextInput::make('og_title')
                            ->label('OG Title'),
                        
                        Forms\Components\Textarea::make('og_description')
                            ->label('OG Description')
                            ->rows(2),
                        
                        Forms\Components\FileUpload::make('og_images')
                            ->label('OG Image')
                            ->image()
                            ->imageEditor()
                            ->directory('seo/og-images')
                            ->visibility('public')
                            ->helperText('Upload gambar untuk Open Graph (Facebook). Ukuran optimal: 1200x630px'),
                        
                        Forms\Components\TextInput::make('og_image_width')
                            ->label('OG Image Width')
                            ->default('1200')
                            ->numeric(),
                        
                        Forms\Components\TextInput::make('og_image_height')
                            ->label('OG Image Height')
                            ->default('630')
                            ->numeric(),
                        
                        Forms\Components\Select::make('og_type')
                            ->label('OG Type')
                            ->options([
                                'website' => 'Website',
                                'article' => 'Article',
                                'product' => 'Product',
                            ])
                            ->default('website'),
                        
                        Forms\Components\TextInput::make('og_site_name')
                            ->label('OG Site Name'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Twitter Card')
                    ->schema([
                        Forms\Components\Select::make('twitter_card')
                            ->label('Twitter Card Type')
                            ->options([
                                'summary' => 'Summary',
                                'summary_large_image' => 'Summary Large Image',
                                'app' => 'App',
                                'player' => 'Player',
                            ])
                            ->default('summary_large_image'),
                        
                        Forms\Components\TextInput::make('twitter_title')
                            ->label('Twitter Title'),
                        
                        Forms\Components\Textarea::make('twitter_description')
                            ->label('Twitter Description')
                            ->rows(2),
                        
                        Forms\Components\FileUpload::make('twitter_images')
                            ->label('Twitter Image')
                            ->image()
                            ->imageEditor()
                            ->directory('seo/twitter-images')
                            ->visibility('public')
                            ->helperText('Upload gambar untuk Twitter Card. Ukuran optimal: 1200x630px'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Pinterest & Microsoft')
                    ->schema([
                        Forms\Components\Textarea::make('pinterest_description')
                            ->label('Pinterest Description')
                            ->rows(2),
                        
                        Forms\Components\FileUpload::make('pinterest_images')
                            ->label('Pinterest Image')
                            ->image()
                            ->imageEditor()
                            ->directory('seo/pinterest-images')
                            ->visibility('public')
                            ->helperText('Upload gambar untuk Pinterest. Ukuran optimal: 1000x1500px (2:3 ratio)'),
                        
                        Forms\Components\ColorPicker::make('msapplication_tile_color')
                            ->label('MS Application Tile Color'),
                        
                        Forms\Components\FileUpload::make('ms_tile_images')
                            ->label('MS Application Tile Image')
                            ->image()
                            ->imageEditor()
                            ->directory('seo/ms-tile-images')
                            ->visibility('public')
                            ->helperText('Upload gambar untuk Microsoft Tile. Ukuran optimal: 144x144px'),
                    ])->columns(2),
                
                Forms\Components\Section::make('URLs & Icons')
                    ->schema([
                        Forms\Components\TextInput::make('canonical_url')
                            ->label('Canonical URL')
                            ->url(),
                        
                        Forms\Components\FileUpload::make('favicons')
                            ->label('Favicon')
                            ->image()
                            ->directory('seo/favicons')
                            ->visibility('public')
                            ->helperText('Upload favicon (.ico atau .png). Ukuran optimal: 32x32px atau 16x16px'),
                        
                        Forms\Components\FileUpload::make('apple_touch_icons')
                            ->label('Apple Touch Icon')
                            ->image()
                            ->directory('seo/apple-touch-icons')
                            ->visibility('public')
                            ->helperText('Upload Apple Touch Icon (.png). Ukuran optimal: 180x180px'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSeoSettings::route('/'),
        ];
    }
}
