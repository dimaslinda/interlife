<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\DeleteAction::make()
                ->label('Hapus User')
                ->requiresConfirmation()
                ->modalHeading('Hapus User')
                ->modalDescription('Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('User berhasil dihapus!')
                        ->body('User telah dihapus dari sistem.')
                ),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User berhasil diperbarui!')
            ->body('Informasi user telah berhasil disimpan.')
            ->icon('heroicon-o-check-circle')
            ->iconColor('success')
            ->duration(5000);
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Jangan update password jika kosong
        if (empty($data['password'])) {
            unset($data['password']);
        }
        
        return $data;
    }
}
