<?php

namespace App\Filament\Resources\ProcessResource\Pages;

use App\Filament\Resources\ProcessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditProcess extends EditRecord
{
    protected static string $resource = ProcessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Proses berhasil dihapus')
                        ->body('Data proses telah dihapus dari sistem.')
                        ->duration(5000)
                        ->icon('heroicon-o-trash')
                ),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Proses berhasil diperbarui')
            ->body('Data proses telah diperbarui dengan sukses.')
            ->duration(5000)
            ->icon('heroicon-o-pencil-square');
    }
}
