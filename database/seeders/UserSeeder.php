<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@interlife.com',
            'password' => Hash::make('password123'),
            'phone' => '+62 812 3456 7890',
            'bio' => 'Administrator sistem dengan akses penuh ke semua fitur.',
            'email_verified_at' => now(),
            'last_login_at' => now()->subDays(1),
            'last_login_ip' => '192.168.1.1',
        ]);

        // Content User
        User::create([
            'name' => 'Content Manager',
            'email' => 'content@interlife.com',
            'password' => Hash::make('password123'),
            'phone' => '+62 813 4567 8901',
            'bio' => 'Content manager yang bertanggung jawab mengelola portfolio dan artikel.',
            'email_verified_at' => now(),
            'last_login_at' => now()->subHours(3),
            'last_login_ip' => '192.168.1.2',
        ]);

        // Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@interlife.com',
            'password' => Hash::make('password123'),
            'phone' => '+62 814 5678 9012',
            'bio' => 'User reguler sistem.',
            'email_verified_at' => now(),
            'last_login_at' => now()->subMinutes(30),
            'last_login_ip' => '192.168.1.3',
        ]);

        // Marketing User
        User::create([
            'name' => 'Marketing Specialist',
            'email' => 'marketing@interlife.com',
            'password' => Hash::make('password123'),
            'phone' => '+62 815 6789 0123',
            'bio' => 'Marketing specialist yang mengelola promosi dan kampanye.',
            'email_verified_at' => now(),
            'last_login_at' => now()->subWeeks(2),
            'last_login_ip' => '192.168.1.4',
        ]);

        // Designer User
        User::create([
            'name' => 'Creative Designer',
            'email' => 'designer@interlife.com',
            'password' => Hash::make('password123'),
            'phone' => '+62 816 7890 1234',
            'bio' => 'Creative designer yang bertanggung jawab atas desain visual.',
            'email_verified_at' => now(),
            'last_login_at' => now()->subMonths(1),
            'last_login_ip' => '192.168.1.5',
        ]);

        // Additional User
        User::create([
            'name' => 'Sarah Manager',
            'email' => 'sarah@interlife.com',
            'password' => Hash::make('password123'),
            'phone' => '+62 817 8901 2345',
            'bio' => 'Manager senior dengan pengalaman 5 tahun di bidang interior design.',
            'email_verified_at' => now(),
            'last_login_at' => now()->subHours(1),
            'last_login_ip' => '192.168.1.6',
        ]);

        // Additional User
        User::create([
            'name' => 'John Analyst',
            'email' => 'john@interlife.com',
            'password' => Hash::make('password123'),
            'phone' => '+62 818 9012 3456',
            'bio' => 'Analyst yang fokus pada analisis data dan reporting.',
            'email_verified_at' => now(),
            'last_login_at' => now()->subMinutes(15),
            'last_login_ip' => '192.168.1.7',
        ]);
    }
}
