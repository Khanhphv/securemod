<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Trần Trùng Trục',
            'email' => 'admin@admin.com',
            'user_ref_count' => 3,
            'user_ref_commission' => 1,
            'phone' => '0912345678',
            'password' => bcrypt('matkhau'),
            'type' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'lalala',
            'email' => 'lalala@gmail.com',
            'user_ref_count' => 123,
            'user_ref_commission' => 5,
            'phone' => '0912345678',
            'password' => bcrypt('matkhau'),
            'type' => 'default'
        ]);

        DB::table('users')->insert([
            'name' => 'andrewbuisness1',
            'email' => 'andrewbuisness1@gmail.com',
            'user_ref_count' => 13,
            'user_ref_commission' => 5,
            'phone' => '0912345678',
            'password' => bcrypt('matkhau'),
            'type' => 'default'
        ]);
    }
}
