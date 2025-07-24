<?php

namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateFeature extends CreateRecord
{
    protected static string $resource = FeatureResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Fitur Berhasil Dibuat! ⭐')
            ->body('Fitur baru telah berhasil ditambahkan dan siap untuk ditampilkan di website.')
            ->duration(5000)
            ->icon('heroicon-o-star');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
