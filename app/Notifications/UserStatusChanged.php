<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $oldStatus;
    public $newStatus;
    public $changedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct($oldStatus, $newStatus, $changedBy)
    {
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->changedBy = $changedBy;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusText = [
            'active' => 'Aktif',
            'inactive' => 'Tidak Aktif',
            'suspended' => 'Suspended'
        ];

        $subject = 'Status Akun Anda Telah Diubah';
        $greeting = 'Halo ' . $notifiable->name . ',';
        
        $message = (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line('Status akun Anda telah diubah oleh administrator.')
            ->line('Status sebelumnya: **' . ($statusText[$this->oldStatus] ?? $this->oldStatus) . '**')
            ->line('Status baru: **' . ($statusText[$this->newStatus] ?? $this->newStatus) . '**')
            ->line('Diubah oleh: ' . $this->changedBy);

        if ($this->newStatus === 'active') {
            $message->action('Login ke Dashboard', url('/admin/login'))
                    ->line('Sekarang Anda dapat mengakses dashboard kembali.');
        } elseif ($this->newStatus === 'suspended') {
            $message->line('Akun Anda telah di-suspend. Silakan hubungi administrator untuk informasi lebih lanjut.');
        } else {
            $message->line('Jika Anda memiliki pertanyaan, silakan hubungi administrator.');
        }

        return $message->line('Terima kasih telah menggunakan layanan kami.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Status Akun Diubah',
            'message' => 'Status akun Anda telah diubah dari ' . $this->oldStatus . ' menjadi ' . $this->newStatus,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'changed_by' => $this->changedBy,
            'changed_at' => now()->toISOString(),
        ];
    }
}
