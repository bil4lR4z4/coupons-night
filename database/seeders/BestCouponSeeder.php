<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\BestCoupon;

class BestCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BestCoupon::insert([
            [
                'id' => 10,
                'store_id' => 1,
                'title' => '40% Off ON Storewide',
                'html_link' => 'https://www.gymshark.com/products/gymshark-vital-sports-bra-sports-bras-black-ss26',
                'image' => '1780839371_best_coupon_6a2573cb4a20b.jpg',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2026-06-07 17:36:11',
                'updated_at' => '2026-06-07 17:36:11',
            ],
            [
                'id' => 9,
                'store_id' => 2,
                'title' => '60% Off On Sitewide',
                'html_link' => 'https://www.amazon.com/IQYNAM-Slip-Resistant-Breathable-Athletic-Sneakers/dp/B0FK55XJ98/ref=sr_1_3',
                'image' => '1780480670_best_coupon_6a1ffa9e8b314.jpg',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2026-06-03 13:57:50',
                'updated_at' => '2026-06-03 13:57:50',
            ],
            [
                'id' => 11,
                'store_id' => 3,
                'title' => '40% Off On Sitewide',
                'html_link' => 'https://www.aliexpress.com/item/1005011939969672.html',
                'image' => '1780841500_best_coupon_6a257c1cb389d.jpg',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2026-06-07 18:11:40',
                'updated_at' => '2026-06-07 18:11:40',
            ],
            [
                'id' => 12,
                'store_id' => 4,
                'title' => 'DareSee 16pcs Vintage Geometric Hollow Hinge Rings',
                'html_link' => 'https://us.shein.com/DareSee-16pcs-Vintage-Geometric-Hollow-Hinge-Rings-Set',
                'image' => '1780849817_best_coupon_6a259c99c1b5a.jpg',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2026-06-07 20:30:17',
                'updated_at' => '2026-06-07 20:30:17',
            ],
            [
                'id' => 13,
                'store_id' => 5,
                'title' => 'Wireless On-Ear Earpods For $6.07',
                'html_link' => 'https://www.temu.com/2025-new-style-true-wireless-on-ear-earpods',
                'image' => '1780851562_best_coupon_6a25a36a73d80.jpg',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2026-06-07 20:59:22',
                'updated_at' => '2026-06-07 20:59:22',
            ],
            
        ]);
    }
}
