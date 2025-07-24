<?php

namespace App\Filament\Resources\PortfolioCategoryResource\Pages;

use App\Filament\Resources\PortfolioCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePortfolioCategory extends CreateRecord
{
    protected static string $resource = PortfolioCategoryResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Kategori Portfolio Berhasil Dibuat! 📁')
            ->body('Kategori portfolio baru telah berhasil ditambahkan dan siap digunakan.')
            ->duration(5000)
            ->icon('heroicon-o-folder-plus');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
