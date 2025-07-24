<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Kontak berhasil dibuat')
            ->body('Data kontak baru telah ditambahkan ke sistem.')
            ->duration(5000)
            ->icon('heroicon-o-plus-circle');
    }
}
