<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected ServiceCategory $carWashCategory;

    protected ServiceCategory $homeCleanCategory;

    protected Service $carService;

    protected Service $homeService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carWashCategory = ServiceCategory::create([
            'name' => 'Car Wash & Car Detailing',
            'slug' => 'car-wash',
            'icon' => 'car',
            'is_active' => true,
        ]);

        $this->homeCleanCategory = ServiceCategory::create([
            'name' => 'Home Cleaning Service',
            'slug' => 'home-cleaning',
            'icon' => 'sparkles',
            'is_active' => true,
        ]);

        $this->carService = Service::create([
            'service_category_id' => $this->carWashCategory->id,
            'name' => 'Full Car Wash & Hydro Wax',
            'slug' => 'full-car-wash',
            'price' => 180000,
            'duration_minutes' => 90,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $this->homeService = Service::create([
            'service_category_id' => $this->homeCleanCategory->id,
            'name' => 'Deep Cleaning Total',
            'slug' => 'deep-cleaning',
            'price' => 350000,
            'duration_minutes' => 240,
            'is_active' => true,
            'is_featured' => true,
        ]);
    }

    public function test_booking_form_page_can_be_rendered(): void
    {
        $response = $this->get(route('booking'));

        $response->assertStatus(200);
        $response->assertSee('Pemesanan Layanan');
        $response->assertSee('Car Wash');
    }

    public function test_customer_can_create_car_wash_booking_successfully(): void
    {
        $bookingData = [
            'service_category_id' => $this->carWashCategory->id,
            'service_id' => $this->carService->id,
            'customer_name' => 'Budi Santoso',
            'customer_phone' => '081234567890',
            'customer_email' => 'budi@example.com',
            'service_date' => Carbon::tomorrow()->toDateString(),
            'service_time' => '10:00',
            'service_address' => 'Jl. Tebet Barat Raya No. 10, Jakarta Selatan',
            'vehicle_type' => 'SUV / Crossover',
            'vehicle_model' => 'Honda CR-V 2021',
            'service_location' => 'Datang ke Workshop',
            'notes' => 'Tolong dibersihkan bagian bagasi.',
        ];

        $response = $this->post(route('booking.store'), $bookingData);

        $booking = Booking::first();

        $this->assertNotNull($booking);
        $this->assertStringStartsWith('JAS-', $booking->booking_code);
        $this->assertEquals('Budi Santoso', $booking->customer_name);
        $this->assertEquals(Booking::STATUS_PENDING, $booking->status);
        $this->assertEquals(180000, (float) $booking->total_price);
        $this->assertEquals('Honda CR-V 2021', $booking->metadata['vehicle_model']);

        $response->assertRedirect(route('booking.confirmation', ['booking' => $booking->booking_code]));
    }

    public function test_booking_validation_requires_mandatory_fields(): void
    {
        $response = $this->post(route('booking.store'), []);

        $response->assertSessionHasErrors([
            'service_category_id',
            'customer_name',
            'customer_phone',
            'service_date',
            'service_time',
            'service_address',
        ]);
    }

    public function test_booking_confirmation_displays_code_and_whatsapp_button(): void
    {
        $booking = Booking::create([
            'booking_code' => 'JAS-20261117-TEST',
            'service_category_id' => $this->carWashCategory->id,
            'service_id' => $this->carService->id,
            'customer_name' => 'Dewi Lestari',
            'customer_phone' => '081299887766',
            'service_date' => Carbon::tomorrow()->toDateString(),
            'service_time' => '13:00',
            'service_address' => 'Jl. Senayan Baru No. 2',
            'total_price' => 180000,
            'status' => Booking::STATUS_PENDING,
        ]);

        $response = $this->get(route('booking.confirmation', ['booking' => $booking->booking_code]));

        $response->assertStatus(200);
        $response->assertSee('JAS-20261117-TEST');
        $response->assertSee('Dewi Lestari');
        $response->assertSee('api.whatsapp.com');
    }

    public function test_booking_tracking_lookup_finds_record(): void
    {
        $booking = Booking::create([
            'booking_code' => 'JAS-20261117-TRACK',
            'service_category_id' => $this->homeCleanCategory->id,
            'service_id' => $this->homeService->id,
            'customer_name' => 'Faisal Rahman',
            'customer_phone' => '081311223344',
            'service_date' => Carbon::tomorrow()->toDateString(),
            'service_time' => '09:00',
            'service_address' => 'Cluster Bintaro Jaya Sektor 7',
            'total_price' => 350000,
            'status' => Booking::STATUS_CONFIRMED,
        ]);

        $response = $this->get(route('booking.track', ['q' => 'JAS-20261117-TRACK']));

        $response->assertStatus(200);
        $response->assertSee('Faisal Rahman');
        $response->assertSee('Terkonfirmasi');
    }
}
