<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'option' => 'payment_gate',
            'value' => 'thuthe',
            'locate' => 'vi'
		]);
		DB::table('options')->insert([
            'option' => 'header_sub_title',
            'value' => 'ĐÃ UPDATE BẢN MỚI NHẤT 0.12',
            'locate' => 'vi'
		]);
		DB::table('options')->insert([
            'option' => 'header_notice',
            'value' => 'File tải về đã có đủ bản 0.11 (cũ) và 0.12 (mới nhất). Một số máy không tải được tool do Windows Defender nhận nhầm Virus. Bạn hãy update lên Windows 10 bản mới nhất, hoặc tắt tạm WD.<br><br>Cách triệt để nhất là xóa Windows Defender theo <a href="https://vhieu.com/tin-tuc/huong-dan-xoa-vinh-vien-windows-defender-mien-phi-voi-windows-10-tweaker-871.html" target="_blank" rel="nofollow">hướng dẫn này</a>',
            'locate' => 'vi'
		]);
        DB::table('options')->insert([
            'option' => 'commission',
            'value' => 3,
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'header_title',
            'value' => 3,
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'popup',
            'value' => 'Nội dung thông báo',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'float_content_left',
            'value' => 'Nội dung thông báo chạy ở bên trái web',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'float_content_right',
            'value' => 'Nội dung thông báo chạy ở bên phải web',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'header_code',
            'value' => null,
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'gate_gamebank',
            'value' => '1234656',
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'payment_gate',
            'value' => '...',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'ptram_chap_nhan_thanh_toan',
            'value' => '100',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'coinpayment_bonus',
            'value' => '10',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'paypal_client_id',
            'value' => 'AZD3imApo6RAnkSsuIHn6YRBQdCPFaVSsUYQ3O6J-LKSEEvvgKYYMCv2dUY_RrZMW56uZ7o8DuDwMftf',
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'paypal_client_secret',
            'value' => 'EBqrX5N9n1fNppd1D1wVCkFJ0PyvV8FpD6xoev3xForef2WSrsKGz_EngfpLsrh8SmH-WqXVhZYLJfhc',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'paypal_id',
            'value' => '5',
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'auto-accept',
            'value' => '0',
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'coin_payment',
            'value' => '1',
            'locate' => 'vi'
        ]);

        DB::table('options')->insert([
            'option' => 'discord_channel',
            'value' => 'Nội dung thông báo chạy ở bên phải web',
            'locate' => 'vi'
        ]);
        DB::table('options')->insert([
            'option' => 'stripe_payment',
            'value' => '1',
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'seller_payment',
            'value' => '1',
            'locate' => 'en'
        ]);
        DB::table('options')->insert([
            'option' => 'paypal_payment',
            'value' => '1',
            'locate' => 'en'
        ]);
    }
}
