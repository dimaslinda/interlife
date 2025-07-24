<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePartner extends CreateRecord
{
    protected static string $resource = PartnerResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Partner Berhasil Dibuat! 🤝')
            ->body('Partner baru telah ditambahkan dan siap ditampilkan di website.')
            ->success()
            ->duration(5000)
            ->icon('heroicon-o-building-office-2');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
