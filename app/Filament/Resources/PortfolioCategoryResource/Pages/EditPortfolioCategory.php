<?php

namespace App\Filament\Resources\PortfolioCategoryResource\Pages;

use App\Filament\Resources\PortfolioCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditPortfolioCategory extends EditRecord
{
    protected static string $resource = PortfolioCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Kategori Portfolio Berhasil Dihapus! 🗑️')
                        ->body('Kategori portfolio telah berhasil dihapus dari sistem.')
                        ->duration(5000)
                        ->icon('heroicon-o-trash')
                ),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Kategori Portfolio Berhasil Diperbarui! ✨')
            ->body('Perubahan kategori portfolio telah berhasil disimpan.')
            ->duration(5000)
            ->icon('heroicon-o-pencil-square');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
