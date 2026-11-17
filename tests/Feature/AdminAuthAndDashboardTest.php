<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\ServiceCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthAndDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected ServiceCategory $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::create([
            'name' => 'Admin Jasmine Test',
            'email' => 'admin@jasmineservices.com',
            'password' => Hash::make('secretpassword'),
            'role' => 'admin',
        ]);

        $this->category = ServiceCategory::create([
            'name' => 'Car Wash & Car Detailing',
            'slug' => 'car-wash',
            'icon' => 'car',
            'is_active' => true,
        ]);
    }

    public function test_guest_is_redirected_when_accessing_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@jasmineservices.com',
            'password' => 'secretpassword',
        ]);

        $this->assertAuthenticatedAs($this->adminUser);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_cannot_login_with_invalid_password(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@jasmineservices.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_admin_can_view_dashboard_metrics(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Ringkasan & Aktivitas');
        $response->assertSee('Total Booking');
    }

    public function test_admin_can_update_booking_status(): void
    {
        $booking = Booking::create([
            'booking_code' => 'JAS-20261117-STAT',
            'service_category_id' => $this->category->id,
            'customer_name' => 'Rina Wijaya',
            'customer_phone' => '081299881122',
            'service_date' => Carbon::tomorrow()->toDateString(),
            'service_time' => '11:00',
            'service_address' => 'Jl. Kebayoran Lama No. 5',
            'status' => Booking::STATUS_PENDING,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->put(route('admin.bookings.update_status', $booking), [
                'status' => Booking::STATUS_CONFIRMED,
            ]);

        $response->assertRedirect();
        $this->assertEquals(Booking::STATUS_CONFIRMED, $booking->fresh()->status);
    }

    public function test_admin_can_create_new_service(): void
    {
        $serviceData = [
            'service_category_id' => $this->category->id,
            'name' => 'Ceramic Coating 9H Diamond',
            'slug' => 'ceramic-coating-9h',
            'summary' => 'Perlindungan bodi maksimal 3 tahun',
            'price' => 1500000,
            'price_label' => 'Mulai dari',
            'duration_minutes' => 360,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.services.store'), $serviceData);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'slug' => 'ceramic-coating-9h',
            'price' => 1500000,
        ]);
    }

    public function test_admin_can_update_website_settings(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.settings.update'), [
                'site_name' => 'Jasmine Auto & Home Care',
                'whatsapp_number' => '089912345678',
            ]);

        $response->assertRedirect(route('admin.settings.index'));
        $this->assertDatabaseHas('site_settings', [
            'key' => 'site_name',
            'value' => 'Jasmine Auto & Home Care',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'whatsapp_number',
            'value' => '089912345678',
        ]);
    }

    public function test_user_can_submit_contact_form(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Maya Indah',
            'email' => 'maya@example.com',
            'phone' => '081298765432',
            'subject' => 'Tanya Paket Coating Mobil',
            'message' => 'Halo, apakah ada diskon untuk pengerjaan 2 unit mobil sekaligus?',
        ]);

        $response->assertRedirect(route('contact'));
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Maya Indah',
            'email' => 'maya@example.com',
        ]);
    }
}
