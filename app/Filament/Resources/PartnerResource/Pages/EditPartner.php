<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditPartner extends EditRecord
{
    protected static string $resource = PartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Partner Berhasil Diperbarui! ✨')
            ->body('Informasi partner telah diperbarui dan perubahan akan terlihat di website.')
            ->success()
            ->duration(5000)
            ->icon('heroicon-o-pencil-square');
    }
}
