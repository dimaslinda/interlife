<?php

namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditFeature extends EditRecord
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Fitur Berhasil Dihapus! 🗑️')
                        ->body('Fitur telah berhasil dihapus dari sistem.')
                        ->duration(5000)
                        ->icon('heroicon-o-trash')
                ),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Fitur Berhasil Diperbarui! ✨')
            ->body('Perubahan fitur telah berhasil disimpan dan akan segera terlihat di website.')
            ->duration(5000)
            ->icon('heroicon-o-pencil-square');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
