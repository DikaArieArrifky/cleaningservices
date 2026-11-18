<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carWash = ServiceCategory::where('slug', 'car-wash')->first();
        $homeClean = ServiceCategory::where('slug', 'home-cleaning')->first();

        $galleries = [
            // Car Wash
            [
                'service_category_id' => $carWash?->id,
                'title' => 'Snow Foam Pre-Wash Eksterior',
                'category_tag' => 'Car Wash',
                'caption' => 'Pelapisan busa salju tebal untuk meluruhkan kotoran pasir tanpa menggores pernis cat.',
                'image' => 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'service_category_id' => $carWash?->id,
                'title' => 'Interior Vacuum & Leather Conditioning',
                'category_tag' => 'Interior Detailing',
                'caption' => 'Pembersihan jok kulit premium dengan lotion pelembab khusus anti retak.',
                'image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'service_category_id' => $carWash?->id,
                'title' => 'Nano Ceramic Coating 9H Gloss',
                'category_tag' => 'Coating',
                'caption' => 'Hasil akhir kilap basah (mirror finish) dengan perlindungan hidrofobik maksimal.',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'service_category_id' => $carWash?->id,
                'title' => 'Detailing Velg & Semir Ban',
                'category_tag' => 'Car Wash',
                'caption' => 'Pembersihan debu rem pada kaliper dan velg hingga detail ke sela baut roda.',
                'image' => 'https://images.unsplash.com/photo-1601362840469-51e4d8d58785?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
                'sort_order' => 4,
            ],

            // Home Cleaning
            [
                'service_category_id' => $homeClean?->id,
                'title' => 'Deep Cleaning Ruang Keluarga & Living Room',
                'category_tag' => 'Home Cleaning',
                'caption' => 'Pembersihan menyeluruh karpet, sofa, dan lantai marmer hingga berkilau alami.',
                'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'service_category_id' => $homeClean?->id,
                'title' => 'Degreasing Dapur & Cooker Hood',
                'category_tag' => 'Kitchen',
                'caption' => 'Dapur bebas dari cipratan minyak membandel dan bau tidak sedap.',
                'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'service_category_id' => $homeClean?->id,
                'title' => 'Pembersihan Kerak Kamar Mandi & Kaca Shower',
                'category_tag' => 'Bathroom',
                'caption' => 'Kaca shower yang awalnya buram akibat kerak kapur kini bening seperti baru.',
                'image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
                'sort_order' => 7,
            ],
            [
                'service_category_id' => $homeClean?->id,
                'title' => 'Move-In Cleaning Apartemen Modern',
                'category_tag' => 'Apartment',
                'caption' => 'Unit apartemen siap huni yang sudah disterilkan dan harum menenangkan.',
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
                'sort_order' => 8,
            ],
        ];

        foreach ($galleries as $item) {
            Gallery::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
