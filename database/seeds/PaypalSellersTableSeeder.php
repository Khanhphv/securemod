<?php

use Illuminate\Database\Seeder;

class PaypalSellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paypal_sellers')->insert([
            'seller_name' => 'BOT',
            'discord' => 'Bot#3983',
            'payment_options' => 'Paypal',
            'more_infomation' => 'https://discord.com/channels/762418378924359700/805535604015890452/805559942039863346'
        ]);
        DB::table('paypal_sellers')->insert([
            'seller_name' => 'Razen',
            'discord' => 'Razen#5816',
            'payment_options' => 'Paypal, Payoneer, TransferWise, Western Union, PaysafeCard ,Venmo, CashApp, Zelle, Apple Pay',
            'more_infomation' => 'https://discord.com/channels/762418378924359700/805535604015890452/805559942039863346'
        ]);
    }
}
