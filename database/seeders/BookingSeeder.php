<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carWashCat = ServiceCategory::where('slug', 'car-wash')->first();
        $homeCleanCat = ServiceCategory::where('slug', 'home-cleaning')->first();

        $detailingService = Service::where('slug', 'premium-detailing')->first();
        $fullCarService = Service::where('slug', 'full-car-wash')->first();
        $deepCleaningService = Service::where('slug', 'deep-cleaning')->first();
        $kitchenCleaningService = Service::where('slug', 'kitchen-cleaning')->first();

        $samples = [
            [
                'booking_code' => 'JAS-20261117-001',
                'service_category_id' => $carWashCat?->id,
                'service_id' => $detailingService?->id,
                'customer_name' => 'Aditya Wicaksono',
                'customer_phone' => '081288776655',
                'customer_email' => 'aditya.w@gmail.com',
                'service_date' => Carbon::today()->addDays(1)->toDateString(),
                'service_time' => '09:00',
                'service_address' => 'Jl. Senopati Dalam No. 12, Kebayoran Baru, Jakarta Selatan',
                'notes' => 'Cat mobil warna hitam metalik, ada baret swirl halus di kap mesin tolong diperhatikan.',
                'metadata' => [
                    'vehicle_type' => 'SUV / Crossover',
                    'vehicle_model' => 'Toyota Fortuner GR Sport 2023',
                    'service_location' => 'Datang ke Workshop',
                ],
                'total_price' => 850000,
                'status' => Booking::STATUS_CONFIRMED,
                'admin_notes' => 'Slot workshop bay 2 telah disiapkan, konfirmasi via WA sudah dikirim.',
            ],
            [
                'booking_code' => 'JAS-20261117-002',
                'service_category_id' => $homeCleanCat?->id,
                'service_id' => $deepCleaningService?->id,
                'customer_name' => 'Siti Nurhaliza',
                'customer_phone' => '081399887766',
                'customer_email' => 'siti.nurhaliza@yahoo.com',
                'service_date' => Carbon::today()->addDays(2)->toDateString(),
                'service_time' => '13:00',
                'service_address' => 'Cluster Pasadena Residence Blok B3 No. 7, Bintaro Jaya Sektor 9',
                'notes' => 'Rumah 2 lantai, mohon fokus di area ruang tamu dan kamar utama.',
                'metadata' => [
                    'property_type' => 'Rumah Tinggal (2 Lantai)',
                    'cleaning_focus' => 'Deep clean lantai, vacuum sofa L, dan pembersihan kerak kamar mandi utama.',
                ],
                'total_price' => 350000,
                'status' => Booking::STATUS_PENDING,
                'admin_notes' => null,
            ],
            [
                'booking_code' => 'JAS-20261116-003',
                'service_category_id' => $carWashCat?->id,
                'service_id' => $fullCarService?->id,
                'customer_name' => 'Ferry Santoso',
                'customer_phone' => '081711223344',
                'customer_email' => 'ferry.santoso@outlook.com',
                'service_date' => Carbon::today()->subDay()->toDateString(),
                'service_time' => '10:30',
                'service_address' => 'Apartemen Sudirman Tower A Lantai 15',
                'notes' => 'Layanan Home Service mobil di area parkir basement P2.',
                'metadata' => [
                    'vehicle_type' => 'Sedan',
                    'vehicle_model' => 'Honda Civic RS 2022',
                    'service_location' => 'Home Service (Mobil Keliling)',
                ],
                'total_price' => 180000,
                'status' => Booking::STATUS_COMPLETED,
                'admin_notes' => 'Pekerjaan selesai dengan baik. Pelanggan puas dan memberikan rating 5 bintang.',
            ],
            [
                'booking_code' => 'JAS-20261115-004',
                'service_category_id' => $homeCleanCat?->id,
                'service_id' => $kitchenCleaningService?->id,
                'customer_name' => 'Dewi Anggraini',
                'customer_phone' => '085612348765',
                'customer_email' => 'dewi.anggraini@gmail.com',
                'service_date' => Carbon::today()->subDays(2)->toDateString(),
                'service_time' => '14:00',
                'service_address' => 'Jl. Panglima Polim XIII No. 8, Melawai',
                'notes' => 'Cooker hood sudah lama tidak dibersihkan, banyak kerak minyak.',
                'metadata' => [
                    'property_type' => 'Rumah Tinggal',
                    'cleaning_focus' => 'Degreasing cooker hood dan kompor gas 4 tungku.',
                ],
                'total_price' => 200000,
                'status' => Booking::STATUS_COMPLETED,
                'admin_notes' => 'Selesai. Degreaser premium diaplikasikan tuntas.',
            ],
        ];

        foreach ($samples as $item) {
            Booking::updateOrCreate(['booking_code' => $item['booking_code']], $item);
        }
    }
}
