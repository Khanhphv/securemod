<?php

use Illuminate\Database\Seeder;

class HeadTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('head_tags')->insert([
            'type' => 'home',
            'type_id' => null,
            'head_title' => 'Home',
            'head_description' => 'Best PUBG Cheat'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'list_post',
            'type_id' => null,
            'head_title' => 'Latest News',
            'head_description' => 'Latest News Best PUBG Cheat'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'term',
            'type_id' => null,
            'head_title' => 'Terms of Service',
            'head_description' => 'Terms of Service Best PUBG Cheat'
        ]);

        DB::table('head_tags')->insert([
            'type' => 'post',
            'type_id' => 1,
            'head_title' => 'Post 1 Title',
            'head_description' => 'Post 1 Description'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'game',
            'type_id' => 1,
            'head_title' => 'Game 1 Title',
            'head_description' => 'Game 1 Description'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'game',
            'type_id' => 2,
            'head_title' => 'Game 1 Title',
            'head_description' => 'Game 1 Description'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'game',
            'type_id' => 3,
            'head_title' => 'Game 1 Title',
            'head_description' => 'Game 1 Description'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'game',
            'type_id' => 4,
            'head_title' => 'Game 1 Title',
            'head_description' => 'Game 1 Description'
        ]);
    }
}
