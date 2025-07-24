<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeUser extends Notification implements ShouldQueue
{
    use Queueable;

    public $temporaryPassword;

    /**
     * Create a new notification instance.
     */
    public function __construct($temporaryPassword = null)
    {
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $roleText = [
            'admin' => 'Administrator',
            'editor' => 'Editor',
            'viewer' => 'Viewer'
        ];

        $message = (new MailMessage)
            ->subject('Selamat Datang di InterLife Dashboard')
            ->greeting('Selamat Datang, ' . $notifiable->name . '!')
            ->line('Akun Anda telah berhasil dibuat di sistem InterLife Dashboard.')
            ->line('**Detail Akun:**')
            ->line('Email: ' . $notifiable->email)
            ->line('Role: ' . ($roleText[$notifiable->role] ?? $notifiable->role))
            ->line('Status: Aktif');

        if ($this->temporaryPassword) {
            $message->line('**Password Sementara:** ' . $this->temporaryPassword)
                    ->line('⚠️ **Penting:** Silakan ubah password Anda setelah login pertama kali untuk keamanan akun.');
        }

        $message->action('Login ke Dashboard', url('/admin/login'))
                ->line('Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi tim support kami.')
                ->line('Terima kasih telah bergabung dengan InterLife!');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Selamat Datang!',
            'message' => 'Akun Anda telah berhasil dibuat di InterLife Dashboard',
            'user_email' => $notifiable->email,
            'user_role' => $notifiable->role,
            'created_at' => now()->toISOString(),
        ];
    }
}
