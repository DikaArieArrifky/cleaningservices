<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carWash = ServiceCategory::where('slug', 'car-wash')->first();
        $homeClean = ServiceCategory::where('slug', 'home-cleaning')->first();

        if ($carWash) {
            $carServices = [
                [
                    'service_category_id' => $carWash->id,
                    'name' => 'Exterior Car Wash',
                    'slug' => 'exterior-car-wash',
                    'summary' => 'Cuci bodi luar dengan sampo pH balance, semprotan hidrolik kolong, dan semir ban berkualitas tinggi.',
                    'description' => 'Membersihkan kotoran jalanan, debu, dan lumpur secara tuntas menggunakan sampo khusus ber-pH netral yang aman untuk cat mobil. Dilengkapi dengan pembersihan velg dan semir ban anti-kusam.',
                    'price' => 60000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 45,
                    'features' => [
                        'Cuci salju bodi dengan sampo pH-balanced',
                        'Pembersihan kolong & fender (High-pressure)',
                        'Cuci & sikat velg serta ban',
                        'Pengeringan microfiber anti-scratch',
                        'Tire gel dressing (Semir ban tahan lama)',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1601362840469-51e4d8d58785?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Cepat & Bersih',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Interior Cleaning & Sanitizing',
                    'slug' => 'interior-cleaning',
                    'service_category_id' => $carWash->id,
                    'summary' => 'Pembersihan mendalam kabin mobil, vacuum karpet, jok, dashboard, dan fogging anti-bakteri.',
                    'description' => 'Mengangkat debu halus, remah makanan, noda ringan, dan bau tidak sedap di dalam kabin mobil. Menggunakan formula ramah interior dan diakhiri dengan fogging disinfektan untuk kesegaran maksimal.',
                    'price' => 120000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 60,
                    'features' => [
                        'Full vacuum kabin, sela jok, dan bagasi',
                        'Pembersihan & dressing dashboard serta doortrim',
                        'Pembersihan kaca bagian dalam bebas bercak',
                        'Pencucian karpet dasar dan karet',
                        'Fogging disinfektan & pengharum aromaterapi',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Segar & Higienis',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Full Car Wash & Hydro Wax',
                    'slug' => 'full-car-wash',
                    'service_category_id' => $carWash->id,
                    'summary' => 'Kombinasi cuci eksterior hidrolik, interior detailing ringan, plus pelapisan Hydro Wax kilau protektif.',
                    'description' => 'Paket terfavorit pelanggan kami. Menyajikan perawatan komprehensif mulai dari pembersihan eksterior, pembersihan kabin interior lengkap, hingga aplikasi wax sintetis yang memberikan efek daun talas (hydrophobic) dan kilap basah (wet-look).',
                    'price' => 180000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 90,
                    'features' => [
                        'Semua fitur Exterior & Interior Cleaning',
                        'Aplikasi Hydro Sealant / Spray Wax protektif',
                        'Efek daun talas (Hydrophobic) tahan hingga 1 bulan',
                        'Pembersihan jamur kaca ringan & wiper',
                        'Garansi cuci ulang jika terkena hujan dalam 24 jam',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1507136566006-cfc505b114fc?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Paling Diminati',
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => 3,
                ],
                [
                    'name' => 'Premium Detailing & Coating',
                    'slug' => 'premium-detailing',
                    'service_category_id' => $carWash->id,
                    'summary' => 'Restorasi cat 3-step paint correction, pembersihan ruang mesin, dan lapisan Nano Ceramic Coating.',
                    'description' => 'Perawatan kasta tertinggi untuk mobil kesayangan Anda. Menghilangkan baret halus (swirl mark), mengembalikan kilau cat orisinil dengan pemolesan bertahap, membersihkan ruang mesin (engine bay detailing), dan memproteksi cat dengan lapisan keramik keras.',
                    'price' => 850000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 240,
                    'features' => [
                        '3-Stage Paint Correction (Hilangkan swirl & oksidasi)',
                        'Engine Bay Detailing aman kelistrikan',
                        'Glass Detailing & Water Repellent Treatment',
                        'Deep Interior Scrubbing (jok kulit/fabric & plafon)',
                        'Aplikasi Nano Ceramic 9H Coating bersertifikat',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Ultra Premium',
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => 4,
                ],
            ];

            foreach ($carServices as $service) {
                Service::updateOrCreate(['slug' => $service['slug']], $service);
            }
        }

        if ($homeClean) {
            $homeServices = [
                [
                    'service_category_id' => $homeClean->id,
                    'name' => 'Regular Home Cleaning',
                    'slug' => 'regular-home-cleaning',
                    'summary' => 'Pembersihan harian menyeluruh untuk ruang tamu, kamar tidur, teras, menyapu, mengepel, dan merapikan.',
                    'description' => 'Layanan perawatan kebersihan rutin untuk menjaga kenyamanan keluarga Anda. Petugas kami yang berpengalaman akan merapikan perabotan, membersihkan debu di setiap permukaan, menyapu, dan mengepel lantai dengan cairan aromaterapi pembersih kuman.',
                    'price' => 150000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 120,
                    'features' => [
                        'Menyapu dan mengepel seluruh ruangan',
                        'Dusting meja, rak, kusen jendela, dan furnitur',
                        'Merapikan tempat tidur & mengganti sprei',
                        'Pengosongan tempat sampah dan penggantian plastik',
                        'Sudah termasuk chemical & peralatan lengkap dari kami',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Praktis Harian',
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Deep Cleaning Total',
                    'slug' => 'deep-cleaning',
                    'service_category_id' => $homeClean->id,
                    'summary' => 'Pembersihan total hingga ke sudut tersembunyi, celah lemari, kolong kasur, dan desinfeksi ruangan.',
                    'description' => 'Pembersihan ekstra detail dan mendalam yang ideal dilakukan sebulan sekali atau setelah acara besar. Menjangkau area yang jarang terjamah seperti atas lemari, bawah sofa, exhaust fan, saklar lampu, dan sudut-sudut plafon.',
                    'price' => 350000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 240,
                    'features' => [
                        'Semua fitur Regular Home Cleaning',
                        'Pembersihan mendalam sela & kolong furnitur besar',
                        'Pembersihan sawang (sarang laba-laba) plafon & dinding',
                        'Pembersihan detail daun jendela, ventilasi & exhaust',
                        'Sterilisasi ruangan dengan desinfektan food-grade',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Paling Lengkap',
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Kitchen Cleaning & Degreasing',
                    'slug' => 'kitchen-cleaning',
                    'service_category_id' => $homeClean->id,
                    'summary' => 'Spesialis menghilangkan noda minyak membandel di kompor, cooker hood, kitchen set, dan wastafel.',
                    'description' => 'Mengembalikan dapur Anda menjadi bersih higienis dan bebas bau apek. Kami menggunakan formula degreaser ramah lingkungan untuk meluruhkan kerak minyak membandel pada kompor, backsplash keramik, dinding, dan lemari dapur.',
                    'price' => 200000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 90,
                    'features' => [
                        'Degreasing kompor tanam / kompor gas menyeluruh',
                        'Pembersihan filter & bodi Cooker Hood',
                        'Pembersihan wastafel & pipa pembuangan atas',
                        'Pembersihan permukaan luar lemari kitchen set & kulkas',
                        'Sterilisasi antibakteri area penyiapan makanan',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Bebas Minyak',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 3,
                ],
                [
                    'name' => 'Bathroom Deep Descaling',
                    'slug' => 'bathroom-cleaning',
                    'service_category_id' => $homeClean->id,
                    'summary' => 'Penghilangan kerak air kuning, jamur nat keramik, kloset berkerak, dan kaca shower buram.',
                    'description' => 'Kamar mandi Anda kusam karena noda kerak air kapur dan jamur? Kami memiliki teknik descaling khusus tanpa merusak lapisan keramik asli. Mengilapkan kembali kaca shower, kran air krom, dan membersihkan kloset hingga tuntas.',
                    'price' => 175000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 90,
                    'features' => [
                        'Pembersihan kerak air dinding & lantai keramik',
                        'Descaling kloset duduk/jongkok hingga putih bersih',
                        'Poles kaca shower pembatas dari kerak air membandel',
                        'Pembersihan kran, shower head, dan stainless fittings',
                        'Anti-bacterial & anti-fungal treatment',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Kilap Bebas Kerak',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 4,
                ],
                [
                    'name' => 'Move In / Move Out Cleaning',
                    'slug' => 'move-in-move-out',
                    'service_category_id' => $homeClean->id,
                    'summary' => 'Pembersihan tuntas properti kosong sebelum dihuni atau sebelum diserahterimakan kepada pemilik baru.',
                    'description' => 'Solusi sempurna untuk rumah baru, apartemen sewa, atau setelah renovasi. Tim kami akan membersihkan seluruh debu semen/cat sisa proyek, membersihkan setiap sudut ruangan, jendela, balkon, dan sanitasi menyeluruh agar siap langsung ditempati dengan nyaman.',
                    'price' => 650000,
                    'price_label' => 'Mulai dari',
                    'duration_minutes' => 300,
                    'features' => [
                        'Pembersihan seluruh ruangan properti kosong',
                        'Pengangkatan sisa debu renovasi / cat ringan',
                        'Pembersihan interior & eksterior lemari pakaian & laci',
                        'Pembersihan total kamar mandi & dapur',
                        'Disinfeksi uap dan penyemprotan pewangi ruangan',
                    ],
                    'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                    'badge' => 'Siap Huni',
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => 5,
                ],
            ];

            foreach ($homeServices as $service) {
                Service::updateOrCreate(['slug' => $service['slug']], $service);
            }
        }
    }
}
