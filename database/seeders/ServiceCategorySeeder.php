<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Car Wash & Car Detailing',
                'slug' => 'car-wash',
                'icon' => 'car',
                'tagline' => 'Perawatan Kendaraan Premium & Bersih Berkilau',
                'description' => 'Layanan cuci mobil hidrolik modern, interior deep cleaning, poles bodi 3-step, hingga nano ceramic coating dengan produk bertaraf internasional.',
                'image' => 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Home Cleaning Service',
                'slug' => 'home-cleaning',
                'icon' => 'sparkles',
                'tagline' => 'Kebersihan Total, Sehat & Nyaman untuk Hunian Anda',
                'description' => 'Layanan pembersihan rumah, apartemen, dapur, kamar mandi, hingga hydro cleaning sofa & kasur oleh staf terlatih dengan peralatan modern dan desinfektan ramah lingkungan.',
                'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            ServiceCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
