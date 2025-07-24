<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Banner Berhasil Dihapus! 🗑️')
                        ->body('Banner telah berhasil dihapus dari sistem.')
                        ->duration(5000)
                        ->icon('heroicon-o-trash')
                ),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Banner Berhasil Diperbarui! ✨')
            ->body('Perubahan banner telah berhasil disimpan dan akan segera terlihat di website.')
            ->duration(5000)
            ->icon('heroicon-o-pencil-square');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
