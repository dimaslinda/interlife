<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Kontak berhasil dihapus')
                        ->body('Data kontak telah dihapus dari sistem.')
                        ->duration(5000)
                        ->icon('heroicon-o-trash')
                ),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Kontak berhasil diperbarui')
            ->body('Data kontak telah diperbarui dengan sukses.')
            ->duration(5000)
            ->icon('heroicon-o-pencil-square');
    }
}
