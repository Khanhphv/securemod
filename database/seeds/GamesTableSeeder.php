<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name' => 'PUBG Mobile',
            'slug' => 'pubg-mobile',
            'thumb_image' => 'https://static.digit.in/default/thumb_129666_default_td_480x480.jpeg',
            'description' => 'Đã cập nhật bản mới nhất cho game 0.13',
            'notice' => 'Loa loa loa thông báo ở đầu trang',
            'order' => 10,
            'views' => 1,
            'created_at' => '2021-06-17 12:08:30'
        ]);
        DB::table('games')->insert([
            'name' => 'PUBG Steam',
            'slug' => 'pubg-steam',
            'thumb_image' => 'https://static.digit.in/default/thumb_129666_default_td_480x480.jpeg',
            'description' => 'Đã cập nhật bản mới nhất cho game 0.13',
            'notice' => 'Loa loa loa thông báo ở đầu trang',
            'order' => 20,
            'views' => 1,
            'created_at' => '2021-06-17 12:08:30'
        ]);

        DB::table('games')->insert([
            'name' => 'Apex Legend',
            'slug' => 'apex-legend',
            'thumb_image' => 'https://static.digit.in/default/thumb_129666_default_td_480x480.jpeg',
            'description' => 'Đã cập nhật bản mới nhất cho game 0.13',
            'notice' => 'Loa loa loa thông báo ở đầu trang',
            'order' => 30,
            'views' => 1,
            'created_at' => '2021-06-17 12:08:30'
        ]);

        DB::table('games')->insert([
            'name' => 'Apex Legend123',
            'slug' => 'apex-legend-123',
            'thumb_image' => 'https://static.digit.in/default/thumb_129666_default_td_480x480.jpeg',
            'description' => 'Đã cập nhật bản mới nhất cho game 0.13',
            'notice' => 'Loa loa loa thông báo ở đầu trang',
            'order' => 30,
            'views' => 1,
            'created_at' => '2021-06-17 12:08:30'
        ]);
    }
}
