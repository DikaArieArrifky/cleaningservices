<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password 
                            {email? : Alamat email admin yang ingin direset}
                            {--password= : Password baru (akan ditanyakan secara rahasia jika dikosongkan)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mereset password akun administrator secara aman';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('=== Reset Password Administrator Jasmine Services ===');

        $email = $this->argument('email') ?: $this->ask('Masukkan Alamat Email Administrator');
        $admin = User::where('email', trim((string) $email))->where('role', 'admin')->first();

        if (! $admin) {
            $this->error("Akun administrator dengan email '{$email}' tidak ditemukan.");

            return Command::FAILURE;
        }

        $password = $this->option('password');
        if (empty($password)) {
            $password = $this->secret('Masukkan Password Baru (minimal 8 karakter)');
            while (strlen((string) $password) < 8) {
                $this->error('Password harus minimal 8 karakter.');
                $password = $this->secret('Masukkan Password Baru (minimal 8 karakter)');
            }

            $confirm = $this->secret('Konfirmasi Password Baru');
            while ($password !== $confirm) {
                $this->error('Konfirmasi password tidak cocok. Silakan coba lagi.');
                $password = $this->secret('Masukkan Password Baru (minimal 8 karakter)');
                $confirm = $this->secret('Konfirmasi Password Baru');
            }
        }

        $admin->update([
            'password' => Hash::make((string) $password),
        ]);

        $this->newLine();
        $this->info("✓ Password untuk admin '{$admin->email}' berhasil diperbarui dengan aman!");

        return Command::SUCCESS;
    }
}
