<?php

namespace App\Filament\Resources\SeoSettingResource\Pages;

use App\Filament\Resources\SeoSettingResource;
use App\Models\SeoSetting;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class ManageSeoSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = SeoSettingResource::class;

    protected static string $view = 'filament.resources.seo-setting-resource.pages.manage-seo-settings';

    public ?array $data = [];
    
    public ?SeoSetting $record = null;

    public function mount(): void
    {
        $this->record = SeoSetting::first();
        
        if ($this->record) {
            $this->form->fill($this->record->attributesToArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return SeoSettingResource::form($form)
            ->statePath('data')
            ->model($this->record ?? SeoSetting::class);
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
            
            if ($this->record) {
                $this->record->update($data);
                $isNew = false;
            } else {
                $this->record = SeoSetting::create($data);
                $isNew = true;
            }
            
            // Handle file uploads for media library
            $this->form->model($this->record)->saveRelationships();
            
            Notification::make()
                ->success()
                ->title($isNew ? 'SEO Setting berhasil dibuat!' : 'SEO Setting berhasil diperbarui!')
                ->body($isNew ? 'Data SEO setting baru telah berhasil ditambahkan.' : 'Data SEO setting telah berhasil diperbarui.')
                ->duration(5000)
                ->icon('heroicon-o-check-circle')
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Terjadi kesalahan!')
                ->body('Gagal menyimpan data SEO setting: ' . $e->getMessage())
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