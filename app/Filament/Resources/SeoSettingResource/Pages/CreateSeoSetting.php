<?php

namespace App\Filament\Resources\SeoSettingResource\Pages;

use App\Filament\Resources\SeoSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateSeoSetting extends CreateRecord
{
    protected static string $resource = SeoSettingResource::class;
    
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('SEO Setting berhasil dibuat!')
            ->body('Data SEO setting baru telah berhasil ditambahkan.')
            ->duration(5000)
            ->icon('heroicon-o-check-circle');
    }
}
