<?php

namespace App\Filament\Resources\ProcessResource\Pages;

use App\Filament\Resources\ProcessResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateProcess extends CreateRecord
{
    protected static string $resource = ProcessResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Proses berhasil dibuat')
            ->body('Data proses baru telah ditambahkan ke sistem.')
            ->duration(5000)
            ->icon('heroicon-o-plus-circle');
    }
}
