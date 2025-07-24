<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TestEmailVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-verification {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email verification without queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if ($email) {
            $user = User::where('email', $email)->first();
        } else {
            $user = User::first();
        }

        if (!$user) {
            $this->error('User not found!');
            return 1;
        }

        $this->info("Sending email verification to: {$user->email}");
        
        try {
            $user->sendEmailVerificationNotification();
            $this->info('Email verification sent successfully!');
            $this->info('Check your mail logs or email inbox.');
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}