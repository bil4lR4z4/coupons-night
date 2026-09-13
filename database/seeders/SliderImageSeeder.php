<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\SliderImage;

class SliderImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SliderImage::insert([
            [
                'id' => 1,
                'type' => 'slider',
                'image' => '1778185496_69fcf51818512.png',
                'sort_order' => 0,
                'status' => 'enable',
                'created_at' => '2026-05-17 17:57:09',
                'updated_at' => '2026-05-31 20:42:05',
            ],

            [
                'id' => 2,
                'type' => 'slider',
                'image' => '1778185598_69fcf57e35ea8.png',
                'sort_order' => 0,
                'status' => 'enable',
                'created_at' => '2026-05-17 17:57:09',
                'updated_at' => '2026-05-31 20:42:05',
            ],

            [
                'id' => 3,
                'type' => 'slider',
                'image' => '1778185773_69fcf62de0063.png',
                'sort_order' => 0,
                'status' => 'enable',
                'created_at' => '2026-05-17 17:57:09',
                'updated_at' => '2026-05-31 20:42:05',
            ],
        ]);
    }
}
