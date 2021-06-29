<?php

use Illuminate\Database\Seeder;

class HistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('histories')->insert([
            'user_id' => 1,
            'action' => 'BUY_KEY',
            'nl_token' => null,
            'amount' => 0,
            'revenue' => 0,
            'content' => 'Buy tool BEAR package 2. Your balance from 10 to 10',
            'created_at' => '2019-12-17 07:02:45',
            'need_to_verify' => 0
		]);

        DB::table('histories')->insert([
            'user_id' => 1,
            'action' => 'ADMIN_CONG',
            'nl_token' => null,
            'amount' => 2,
            'revenue' => null,
            'content' => 'Quản trị viên  số 1 đã thay đổi số tiền từ 10 ->  12',
            'created_at' => '2019-12-17 07:02:45',
            'need_to_verify' => 0
		]);

        DB::table('histories')->insert([
            'user_id' => 1,
            'action' => 'CHARGE_VIA_COINPAYMENTS',
            'nl_token' => 'CPDL6V8AJV2WRZOLVMRLK47MBO',
            'amount' => 0,
            'revenue' => null,
            'content' => 'Charging via CoinPayments, transaction code is CPDL6V8AJV2WRZOLVMRLK47MBO. Balance from 11.90 to 12.00',
            'created_at' => '2019-12-17 07:02:45',
            'need_to_verify' => 0
		]);

        DB::table('histories')->insert([
            'user_id' => 1,
            'action' => 'CHARGE_VIA_PAYPAL',
            'nl_token' => '65129625GT6066841',
            'amount' => 0,
            'revenue' => null,
            'content' => 'Charging via Paypal, transaction code is CPDL6V8AJV2WRZOLVMRLK47MBO. Balance from 11.90 to 12.00',
            'created_at' => '2019-12-17 07:02:45',
            'need_to_verify' => 0
		]);
    }
}
