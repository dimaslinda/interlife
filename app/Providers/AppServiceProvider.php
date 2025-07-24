<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Event listener untuk melacak login terakhir
        Event::listen(Login::class, function (Login $event) {
            if ($event->user instanceof User) {
                $event->user->update([
                    'last_login_at' => now(),
                    'last_login_ip' => request()->ip(),
                ]);
            }
        });

        // Event listener untuk mengirim email verifikasi saat user baru dibuat
        Event::listen(Registered::class, function (Registered $event) {
            $event->user->sendEmailVerificationNotification();
        });
    }
}
