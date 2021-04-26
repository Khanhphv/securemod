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
            'value' => 'thuthe'
		]);
		DB::table('options')->insert([
            'option' => 'header_sub_title',
            'value' => 'ĐÃ UPDATE BẢN MỚI NHẤT 0.12'
		]);
		DB::table('options')->insert([
            'option' => 'header_notice',
            'value' => 'File tải về đã có đủ bản 0.11 (cũ) và 0.12 (mới nhất). Một số máy không tải được tool do Windows Defender nhận nhầm Virus. Bạn hãy update lên Windows 10 bản mới nhất, hoặc tắt tạm WD.<br><br>Cách triệt để nhất là xóa Windows Defender theo <a href="https://vhieu.com/tin-tuc/huong-dan-xoa-vinh-vien-windows-defender-mien-phi-voi-windows-10-tweaker-871.html" target="_blank" rel="nofollow">hướng dẫn này</a>'
		]);
        DB::table('options')->insert([
            'option' => 'commission',
            'value' => 3
        ]);
        DB::table('options')->insert([
            'option' => 'popup',
            'value' => 'Nội dung thông báo'
        ]);
        DB::table('options')->insert([
            'option' => 'float_content_left',
            'value' => 'Nội dung thông báo chạy ở bên trái web'
        ]);
        DB::table('options')->insert([
            'option' => 'float_content_right',
            'value' => 'Nội dung thông báo chạy ở bên phải web'
        ]);
    }
}
