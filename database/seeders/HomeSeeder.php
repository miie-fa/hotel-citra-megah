<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sec_1_title' => 'Judul Bagian 1',
                'sec_1_subtitle' => 'Subjudul Bagian 1',
                'sec_1_limit' => 'Batas Bagian 1',
                'sec_1_is_view' => true,
                'sec_2_image' => 'gambar2.jpg',
                'sec_2_title' => 'Judul Bagian 2',
                'sec_2_subtitle' => 'Subjudul Bagian 2',
                'sec_2_button' => 'Tombol Bagian 2',
                'sec_2_button_target' => 'https://www.example.com',
                'sec_2_is_view' => true,
                'sec_3_image' => 'gambar3.jpg',
                'sec_3_title' => 'Judul Bagian 3',
                'sec_3_subtitle' => 'Subjudul Bagian 3',
                'sec_3_icon_1' => 'icon1.png',
                'sec_3_title_1' => 'Judul 1 Bagian 3',
                'sec_3_subtitle_1' => 'Subjudul 1 Bagian 3',
                'sec_3_icon_2' => 'icon2.png',
                'sec_3_title_2' => 'Judul 2 Bagian 3',
                'sec_3_subtitle_2' => 'Subjudul 2 Bagian 3',
                'sec_3_icon_3' => 'icon3.png',
                'sec_3_title_3' => 'Judul 3 Bagian 3',
                'sec_3_subtitle_3' => 'Subjudul 3 Bagian 3',
                'sec_3_is_view' => true,
                'sec_4_title' => 'Judul Bagian 4',
                'sec_4_button' => 'Tombol Bagian 4',
                'sec_4_button_target' => 'https://www.example.com',
                'sec_4_limit' => 'Batas Bagian 4',
                'sec_4_is_view' => true,
                'sec_5_title' => 'Judul Bagian 5',
                'sec_5_subtitle' => 'Subjudul Bagian 5',
                'sec_5_image_1' => 'gambar5_1.jpg',
                'sec_5_title_1' => 'Judul 1 Bagian 5',
                'sec_5_image_2' => 'gambar5_2.jpg',
                'sec_5_title_2' => 'Judul 2 Bagian 5',
                'sec_5_image_3' => 'gambar5_3.jpg',
                'sec_5_title_3' => 'Judul 3 Bagian 5',
                'sec_5_is_view' => true,
                'sec_6_title' => 'Judul Bagian 6',
                'sec_6_subtitle' => 'Subjudul Bagian 6',
                'sec_6_image_1' => 'gambar6_1.jpg',
                'sec_6_title_1' => 'Judul 1 Bagian 6',
                'sec_6_subtitle_1' => 'Subjudul 1 Bagian 6',
                'sec_6_image_2' => 'gambar6_2.jpg',
                'sec_6_title_2' => 'Judul 2 Bagian 6',
                'sec_6_subtitle_2' => 'Subjudul 2 Bagian 6',
                'sec_6_image_3' => 'gambar6_3.jpg',
                'sec_6_title_3' => 'Judul 3 Bagian 6',
                'sec_6_subtitle_3' => 'Subjudul 3 Bagian 6',
                'sec_6_is_view' => true,
                'sec_7_title' => 'Judul Bagian 7',
                'sec_7_subtitle' => 'Subjudul Bagian 7',
                'sec_7_limit' => 'Batas Bagian 7',
                'sec_7_is_view' => true,
                'sec_8_title' => 'Judul Bagian 8',
                'sec_8_is_view' => true,
                'sec_9_title' => 'Judul Bagian 9',
                'sec_9_button' => 'Tombol Bagian 9',
                'sec_9_button_target' => 'https://www.example.com',
                'sec_9_is_view' => true,
            ],
        ];

        Home::insert($data);
    }
}
