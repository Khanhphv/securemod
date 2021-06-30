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
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'user_ref_count' => 3,
            'user_ref_commission' => 1,
            'phone' => '0912345678',
            'credit' => 0,
            'total_paypal_credit' => 0,
            'password' => bcrypt('matkhau'),
            'user_debt' => 0,
            'type' => 'admin',
            'role_member' => 0
        ]);
    }
}
