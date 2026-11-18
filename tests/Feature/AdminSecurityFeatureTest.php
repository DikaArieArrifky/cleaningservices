<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminSecurityFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::create([
            'name' => 'Budi Administrator',
            'email' => 'budi.admin@jasmineservices.id',
            'password' => Hash::make('InitialPassword123!'),
            'role' => 'admin',
        ]);
    }

    public function test_artisan_admin_create_command_creates_valid_admin(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Sari Admin Baru',
            '--email' => 'sari.new@jasmineservices.id',
            '--password' => 'SecurePass999!',
        ])
            ->expectsOutputToContain('Akun Administrator berhasil dibuat dengan aman!')
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'email' => 'sari.new@jasmineservices.id',
            'role' => 'admin',
        ]);

        $created = User::where('email', 'sari.new@jasmineservices.id')->first();
        $this->assertTrue(Hash::check('SecurePass999!', $created->password));
    }

    public function test_artisan_admin_reset_password_command_updates_password(): void
    {
        $this->artisan('admin:reset-password', [
            'email' => $this->adminUser->email,
            '--password' => 'BrandNewSecret2026!',
        ])
            ->expectsOutputToContain('berhasil diperbarui dengan aman!')
            ->assertSuccessful();

        $this->adminUser->refresh();
        $this->assertTrue(Hash::check('BrandNewSecret2026!', $this->adminUser->password));
    }

    public function test_admin_can_access_profile_page(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.profile.edit'));

        $response->assertStatus(200);
        $response->assertSee('Profil & Keamanan Akun');
        $response->assertSee($this->adminUser->email);
    }

    public function test_admin_can_change_password_with_valid_current_password(): void
    {
        $response = $this->actingAs($this->adminUser)->put(route('admin.profile.password'), [
            'current_password' => 'InitialPassword123!',
            'password' => 'SuperNewPassword888',
            'password_confirmation' => 'SuperNewPassword888',
        ]);

        $response->assertRedirect(route('admin.profile.edit'));
        $response->assertSessionHas('success');

        $this->adminUser->refresh();
        $this->assertTrue(Hash::check('SuperNewPassword888', $this->adminUser->password));
    }

    public function test_admin_cannot_change_password_with_wrong_current_password(): void
    {
        $response = $this->actingAs($this->adminUser)->put(route('admin.profile.password'), [
            'current_password' => 'WrongCurrentPassword',
            'password' => 'SuperNewPassword888',
            'password_confirmation' => 'SuperNewPassword888',
        ]);

        $response->assertSessionHasErrors('current_password');

        $this->adminUser->refresh();
        $this->assertFalse(Hash::check('SuperNewPassword888', $this->adminUser->password));
    }
}

