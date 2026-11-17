<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carWash = ServiceCategory::where('slug', 'car-wash')->first();
        $homeClean = ServiceCategory::where('slug', 'home-cleaning')->first();

        $testimonials = [
            [
                'service_category_id' => $carWash?->id,
                'client_name' => 'Bambang Soediro',
                'client_title' => 'Pemilik Honda CR-V Turbo',
                'service_name' => 'Premium Detailing & Coating',
                'rating' => 5,
                'content' => 'Sangat puas dengan hasil detailing di Jasmine Services! Baret-baret swirl di mobil hitam saya hilang total, cat jadi terlihat basah dan efek air daun talasnya luar biasa. Stafnya ramah dan sangat komunikatif via WhatsApp.',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'service_category_id' => $homeClean?->id,
                'client_name' => 'Clarissa Gunawan',
                'client_title' => 'Ibu Rumah Tangga & Entrepreneur',
                'service_name' => 'Deep Cleaning Total Rumah',
                'rating' => 5,
                'content' => 'Paling rekomen untuk cleaning rumah! Rumah 2 lantai dibersihkan sampai ke sela-sela kolong tempat tidur dan atas lemari. Tim datang tepat waktu, berpakaian seragam rapi, dan membawa alat pembersih yang sangat modern.',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'service_category_id' => $carWash?->id,
                'client_name' => 'dr. Rendy Pratama',
                'client_title' => 'Dokter Spesialis & Pengguna Fortuner',
                'service_name' => 'Full Car Wash & Hydro Wax',
                'rating' => 5,
                'content' => 'Paling suka karena bisa request home service atau langsung ke lokasi workshop. Cuci kolongnya bersih tanpa sisa pasir, interiornya wangi segar tanpa bikin pusing. Booking lewat websitenya praktis sekali!',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'service_category_id' => $homeClean?->id,
                'client_name' => 'Novita Wijaya',
                'client_title' => 'Penghuni Apartemen Sudirman',
                'service_name' => 'Kitchen & Bathroom Descaling',
                'rating' => 5,
                'content' => 'Kerak membandel di dinding kaca shower yang sudah bertahun-tahun gak bisa hilang, langsung kinclong seperti baru dalam 2 jam. Kompor yang penuh lemak juga bersih bersinar. Benar-benar profesional!',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }
    }
}
