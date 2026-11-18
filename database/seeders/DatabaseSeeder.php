<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            GallerySeeder::class,
            TestimonialSeeder::class,
            SiteSettingSeeder::class,
        ]);

        if (! app()->environment('production')) {
            $this->call(BookingSeeder::class);
        }
    }
}
