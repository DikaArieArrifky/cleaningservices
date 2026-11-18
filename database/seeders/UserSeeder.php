<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // In production, NEVER seed a default fixed password.
        // Administrators must be created via: php artisan admin:create
        if (app()->environment('production')) {
            $defaultEmail = env('ADMIN_DEFAULT_EMAIL');
            $defaultPassword = env('ADMIN_DEFAULT_PASSWORD');

            if ($defaultEmail && $defaultPassword) {
                User::updateOrCreate(
                    ['email' => $defaultEmail],
                    [
                        'name' => env('ADMIN_DEFAULT_NAME', 'Administrator Jasmine'),
                        'password' => Hash::make($defaultPassword),
                        'role' => 'admin',
                        'email_verified_at' => now(),
                    ]
                );
            }

            return;
        }

        // For local development and automated testing only:
        User::updateOrCreate(
            ['email' => 'admin@jasmineservices.com'],
            [
                'name' => 'Administrator Jasmine',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
