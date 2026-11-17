<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Jasmine Services',
                'group' => 'general',
                'description' => 'Nama brand atau perusahaan',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Premium Car Wash, Auto Detailing & Home Cleaning Service',
                'group' => 'general',
                'description' => 'Slogan singkat perusahaan',
            ],
            [
                'key' => 'whatsapp_number',
                'value' => '081234567890',
                'group' => 'contact',
                'description' => 'Nomor WhatsApp Admin untuk konfirmasi booking otomatis',
            ],
            [
                'key' => 'phone_number',
                'value' => '+62 812-3456-7890',
                'group' => 'contact',
                'description' => 'Nomor telepon kantor / CS',
            ],
            [
                'key' => 'email_address',
                'value' => 'halo@jasmineservices.id',
                'group' => 'contact',
                'description' => 'Alamat email resmi perusahaan',
            ],
            [
                'key' => 'office_address',
                'value' => 'Jl. Boulevard Raya No. 45, Kebayoran Baru, Jakarta Selatan, DKI Jakarta 12150',
                'group' => 'contact',
                'description' => 'Alamat workshop & kantor pusat',
            ],
            [
                'key' => 'operating_hours',
                'value' => 'Senin - Minggu: 08:00 - 18:00 WIB',
                'group' => 'general',
                'description' => 'Jam operasional layanan',
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/jasmineservices.id',
                'group' => 'social',
                'description' => 'Akun Instagram resmi',
            ],
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/jasmineservices.id',
                'group' => 'social',
                'description' => 'Akun Facebook resmi',
            ],
            [
                'key' => 'google_maps_embed',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.284241680582!2d106.8016462747506!3d-6.226207893761899!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f01%3A0x2e2f3d65b82269a9!2sKebayoran%20Baru%2C%20Jakarta%20Selatan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
                'group' => 'contact',
                'description' => 'Embed URL iframe Google Maps',
            ],
            [
                'key' => 'hero_title',
                'value' => 'Kilau Sempurna untuk Mobil Anda, Kebersihan Menyeluruh untuk Rumah Anda',
                'group' => 'homepage',
                'description' => 'Headline utama di halaman beranda',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Layanan perawatan kendaraan dan pembersihan hunian berstandar premium dengan staf profesional, peralatan modern, dan jaminan kepuasan pelanggan 100%.',
                'group' => 'homepage',
                'description' => 'Sub-headline hero section',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
