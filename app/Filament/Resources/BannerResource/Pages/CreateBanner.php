<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Banner Berhasil Dibuat! 🎉')
            ->body('Banner baru telah berhasil ditambahkan dan siap untuk ditampilkan di website.')
            ->duration(5000)
            ->icon('heroicon-o-check-circle');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
