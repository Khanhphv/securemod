<?php

use Illuminate\Database\Seeder;

class LikePostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('like_post')->insert([
            'post_id' => 1,
            'like_count' => 0,
		]);
    }
}
