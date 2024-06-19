<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //
        $data  = [
            [
                'vendor' => 'PiPi Furniture.store',
                'name' => 'PiPi Furniture Meja Belajar Kayu Set Kursi/Meja komputer/Meja Kerja/Meja Laptop/Minimalis/Murah',
                'image' => 'https://down-id.img.susercontent.com/file/sg-11134201-7rbmh-ll8s1orb732q2a',
                'description' => 'Meja bergaya minimalis modern yang sangat cocok untuk dijadikan meja kantor ataupun meja belajar.',
                'url' => 'https://shopee.co.id/product/993944378/22453649815?d_id=a1904&uls_trackid=5025pnfd00dc&utm_content=noG89aUpW5aFw2DQhxxcsasRPZh',
                'price' => 278000
            ],
            [
                'vendor' => 'rumahproject.id',
                'name' => 'DIPAN CUSTOM | STORAGE BED | DIPAN MINIMALIS',
                'image' => 'https://down-id.img.susercontent.com/file/cf9389484a8af3f1949da7da222052f6',
                'description' => 'Bismillah.. Note : HARGA PERMETER PERSEGI BUKAN HARGA 1 SET SEPERTI DI FOTO BAHAN KETEBALAN 18MM (TEBAL) BUKAN BAHAN TIPIS. HATI-HATI TERKECOH DENGAN HARGA YANG LEBIH MURAH😍 Bahan full bukan rangka menggunakan bahan dasar Multiplek/Blokboard/Plywood (bukan partikel board dan mdf yang mudah hancur oleh air) dengan tebal 18mm',
                'url' => 'https://shopee.co.id/product/283150975/14242284093?d_id=a1904&uls_trackid=502a0uo002dc&utm_content=noG89aUpXFJEWG2CDCrttK6qaET',
                'price' => 1650000
            ],

        ];

        foreach ($data as $key => $value) {
            # code...
            Shop::create(
                [
                    'vendor' => $value['vendor'],
                    'name' => $value['name'],
                    'image' => $value['image'],
                    'description' => $value['description'],
                    'url' => $value['url'],
                    'price' => $value['price']
                ]
            );
        }
    }
}
