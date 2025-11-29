<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Area;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin/Customer (Agar bisa login)
        User::create([
            'name' => 'Daffa Raditya',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'), // password: password
        ]);

        // 2. Buat Kategori Utama (Flowers, Leaf, Other)
        // Kita simpan ID kategori Flowers ke variabel untuk dipakai produk
        $catFlowers = Category::create(['name' => 'Flowers', 'slug' => 'flowers']);
        $catLeaf    = Category::create(['name' => 'Leaf', 'slug' => 'leaf']);
        $catOther   = Category::create(['name' => 'Other', 'slug' => 'other']);

        // 3. Masukkan Data Produk Bunga (Sesuai gambar kamu)
        
        $bunga = [
            [
                'name' => 'Mawar Merah Premium',
                'image' => 'flowers/mawar.jpeg', //
                'price' => 15000,
                'desc'  => 'Mawar merah segar dengan kelopak tebal, lambang cinta sejati.'
            ],
            [
                'name' => 'Mawar Putih Suci',
                'image' => 'flowers/mawar putih.jpeg', //
                'price' => 15000,
                'desc'  => 'Mawar putih bersih melambangkan ketulusan dan kesucian.'
            ],
            [
                'name' => 'Baby Breath Bouquet',
                'image' => 'flowers/baby breath.jpeg', //
                'price' => 35000,
                'desc'  => 'Bunga kecil putih yang estetik, sangat cocok untuk dekorasi rustic.'
            ],
            [
                'name' => 'Bunga Pikok Putih',
                'image' => 'flowers/pikok.jpeg', //
                'price' => 20000,
                'desc'  => 'Bunga pikok rimbun, sering dijadikan filler buket agar terlihat penuh.'
            ],
            [
                'name' => 'Krisan Pink',
                'image' => 'flowers/Krisan.jpeg', //
                'price' => 12000,
                'desc'  => 'Bunga krisan dengan warna pink cerah yang tahan lama.'
            ],
            [
                'name' => 'Aster Putih',
                'image' => 'flowers/aster.jpeg', //
                'price' => 18000,
                'desc'  => 'Aster putih cantik yang melambangkan kesabaran dan keanggunan.'
            ],
            [
                'name' => 'Lily Putih Elegant',
                'image' => 'flowers/lily.jpeg', //
                'price' => 45000,
                'desc'  => 'Bunga lily besar yang harum dan memberikan kesan mewah.'
            ],
            [
                'name' => 'Melati Wangi',
                'image' => 'flowers/melati.jpeg', //
                'price' => 10000,
                'desc'  => 'Untaian bunga melati dengan aroma khas yang menenangkan.'
            ],
            [
                'name' => 'Bunga Kemuning',
                'image' => 'flowers/Kemuning.jpeg', //
                'price' => 25000,
                'desc'  => 'Tanaman hias dengan bunga putih kecil yang sangat harum saat mekar.'
            ],
        ];

        // Looping untuk memasukkan data ke database
        foreach ($bunga as $item) {
            Product::create([
                'category_id' => $catFlowers->id, // Masuk kategori Flowers
                'name'        => $item['name'],
                'description' => $item['desc'],
                'price'       => $item['price'],
                'stock'       => 50, // Stok default
                'image'       => $item['image']
            ]);
        }

        // Tambahan Data Dummy untuk Kategori Lain (Supaya tidak kosong)
        Product::create([
            'category_id' => $catLeaf->id,
            'name' => 'Daun Pakis',
            'description' => 'Daun hijau segar untuk pemanis rangkaian.',
            'price' => 5000,
            'stock' => 100,
            'image' => null
        ]);
        
        Product::create([
            'category_id' => $catOther->id,
            'name' => 'Pita Satin Gold',
            'description' => 'Pita mewah untuk hiasan buket.',
            'price' => 7000,
            'stock' => 200,
            'image' => null
        ]);

        // ... (Kode Produk di atas biarkan saja) ...

        // 1. BUAT AREA (Kelompok Harga)
        $areaDekat = \App\Models\Area::create(['nama_area' => 'Area Dekat (Batu & Sekitarnya)', 'ongkir' => 10000]);
        $areaSedang = \App\Models\Area::create(['nama_area' => 'Area Sedang (Malang Kota)', 'ongkir' => 20000]);
        $areaJauh   = \App\Models\Area::create(['nama_area' => 'Area Jauh (Kabupaten/Luar Kota)', 'ongkir' => 35000]);

        // 2. MASUKKAN KOTA KE DALAM AREA
        
        // Kota yang masuk Area Dekat (10rb)
        \App\Models\City::create(['area_id' => $areaDekat->id, 'name' => 'Kec. Batu']);
        \App\Models\City::create(['area_id' => $areaDekat->id, 'name' => 'Kec. Bumiaji']);
        \App\Models\City::create(['area_id' => $areaDekat->id, 'name' => 'Kec. Junrejo']);
        \App\Models\City::create(['area_id' => $areaDekat->id, 'name' => 'Kec. Pujon']);

        // Kota yang masuk Area Sedang (20rb)
        \App\Models\City::create(['area_id' => $areaSedang->id, 'name' => 'Kota Malang - Lowokwaru']);
        \App\Models\City::create(['area_id' => $areaSedang->id, 'name' => 'Kota Malang - Blimbing']);
        \App\Models\City::create(['area_id' => $areaSedang->id, 'name' => 'Kota Malang - Sukun']);
        \App\Models\City::create(['area_id' => $areaSedang->id, 'name' => 'Karangploso']);
        \App\Models\City::create(['area_id' => $areaSedang->id, 'name' => 'Dau']);

        // Kota yang masuk Area Jauh (35rb)
        \App\Models\City::create(['area_id' => $areaJauh->id, 'name' => 'Kepanjen']);
        \App\Models\City::create(['area_id' => $areaJauh->id, 'name' => 'Singosari']);
        \App\Models\City::create(['area_id' => $areaJauh->id, 'name' => 'Lawang']);
    }

    
}