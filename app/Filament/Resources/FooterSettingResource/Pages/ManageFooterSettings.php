<?php

namespace App\Filament\Resources\FooterSettingResource\Pages;

use App\Filament\Resources\FooterSettingResource;
use App\Models\FooterSetting;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class ManageFooterSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = FooterSettingResource::class;

    protected static string $view = 'filament.resources.footer-setting-resource.pages.manage-footer-settings';

    public ?array $data = [];
    
    public ?FooterSetting $record = null;

    public function mount(): void
    {
        $this->record = FooterSetting::first();
        
        if ($this->record) {
            $this->form->fill($this->record->attributesToArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return FooterSettingResource::form($form)
            ->statePath('data')
            ->model($this->record ?? FooterSetting::class);
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
            
            if ($this->record) {
                $this->record->update($data);
                $isNew = false;
            } else {
                $this->record = FooterSetting::create($data);
                $isNew = true;
            }
            
            Notification::make()
                ->success()
                ->title($isNew ? 'Footer Setting berhasil dibuat!' : 'Footer Setting berhasil diperbarui!')
                ->body($isNew ? 'Data footer setting baru telah berhasil ditambahkan.' : 'Data footer setting telah berhasil diperbarui.')
                ->duration(5000)
                ->icon('heroicon-o-check-circle')
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Terjadi kesalahan!')
                ->body('Gagal menyimpan data footer setting: ' . $e->getMessage())
                ->duration(5000)
                ->icon('heroicon-o-x-circle')
                ->send();
        }
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label($this->record ? 'Perbarui' : 'Simpan')
                ->submit('save')
                ->keyBindings(['mod+s'])
                ->color('primary'),
        ];
    }
}
