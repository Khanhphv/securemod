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
            'type' => 'welcome',
            'type_id' => null,
            'head_title' => 'Best PUBG Cheat',
            'head_description' => 'Best PUBG Cheat'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'home',
            'type_id' => null,
            'head_title' => 'Home',
            'head_description' => 'Best PUBG Cheat'
        ]);
        DB::table('head_tags')->insert([
            'type' => 'post',
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
    }
}
