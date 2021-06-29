<?php

use Illuminate\Database\Seeder;

class BlackListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blacklist')->insert([
            'email' => 'lalala@gmail.com'
		]);

        DB::table('blacklist')->insert([
            'email' => 'andrewbuisness1@gmail.com'
		]);
    }
}
