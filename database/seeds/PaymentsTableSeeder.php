<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'payment_type' => 'lex holding',
            'client_id' => 'lex_holding_client_id_1234567',
            'client_secret' => 'lex_holding_client_secret_1234567'
        ]);
        DB::table('payments')->insert([
            'payment_type' => 'paypal',
            'client_id' => 'paypal_client_id_1234567',
            'client_secret' => 'paypal_client_secret_1234567'
        ]);
        DB::table('payments')->insert([
            'payment_type' => 'coin payments',
            'client_id' => 'coin_payments_client_id_1234567',
            'client_secret' => 'coin_payments_client_secret_1234567'
        ]);
        DB::table('payments')->insert([
            'payment_type' => 'btcpay',
            'client_id' => 'token goes here',
            'client_secret' => 'storeid goes here'
        ]);
    }
}
