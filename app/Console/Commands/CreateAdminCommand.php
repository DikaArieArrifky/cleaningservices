<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create 
                            {--name= : Nama lengkap administrator}
                            {--email= : Alamat email administrator}
                            {--password= : Password (akan ditanyakan secara rahasia jika dikosongkan)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat akun administrator baru secara aman tanpa password default';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('=== Pembuatan Akun Administrator Jasmine Services ===');

        // Name
        $name = $this->option('name') ?: $this->ask('Masukkan Nama Lengkap Administrator');
        while (empty(trim((string) $name))) {
            $this->error('Nama wajib diisi.');
            $name = $this->ask('Masukkan Nama Lengkap Administrator');
        }

        // Email
        $email = $this->option('email') ?: $this->ask('Masukkan Alamat Email Administrator');
        $validator = Validator::make(['email' => $email], [
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        while ($validator->fails()) {
            foreach ($validator->errors()->all() as $err) {
                $this->error($err);
            }
            $email = $this->ask('Masukkan Alamat Email Administrator');
            $validator = Validator::make(['email' => $email], [
                'email' => ['required', 'email', 'unique:users,email'],
            ]);
        }

        // Password
        $password = $this->option('password');
        if (empty($password)) {
            $password = $this->secret('Masukkan Password Baru (minimal 8 karakter)');
            while (strlen((string) $password) < 8) {
                $this->error('Password harus minimal 8 karakter demi keamanan production.');
                $password = $this->secret('Masukkan Password Baru (minimal 8 karakter)');
            }

            $confirm = $this->secret('Konfirmasi Password Baru');
            while ($password !== $confirm) {
                $this->error('Konfirmasi password tidak cocok. Silakan coba lagi.');
                $password = $this->secret('Masukkan Password Baru (minimal 8 karakter)');
                $confirm = $this->secret('Konfirmasi Password Baru');
            }
        }

        $admin = User::create([
            'name' => trim((string) $name),
            'email' => strtolower(trim((string) $email)),
            'password' => Hash::make((string) $password),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->newLine();
        $this->info('✓ Akun Administrator berhasil dibuat dengan aman!');
        $this->table(
            ['ID', 'Nama', 'Email', 'Role', 'Status'],
            [[$admin->id, $admin->name, $admin->email, $admin->role, 'Aktif']]
        );

        return Command::SUCCESS;
    }
}
