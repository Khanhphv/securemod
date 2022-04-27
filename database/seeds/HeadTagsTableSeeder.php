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
            'head_title' => 'ZCheat - Game Cheat and Game Hack Application',
            'head_description' => 'Trusted source of game hacks application, game cheats, code for pc games as well as android and iOS mobile games.'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'welcome',
            'type_id' => null,
            'head_title' => 'ZCheat - Game Cheat and Game Hack Application',
            'head_description' => 'Personalize your gaming experience by using ZCheat, the most effective game hacking tool for all your favorite pc games as well as mobile games.'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'list_post',
            'type_id' => null,
            'head_title' => 'ZCheat - Latest News',
            'head_description' => 'Latest News'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'term',
            'type_id' => null,
            'head_title' => 'ZCheat - Terms of Service',
            'head_description' => 'Terms of Service'
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

        DB::table('head_tags')->insert([
            'type' => 'game',
            'type_id' => 5,
            'head_title' => 'Game 5 Title',
            'head_description' => 'Game 5 Description'
        ]);
    }
}
