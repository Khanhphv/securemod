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
    }
}
