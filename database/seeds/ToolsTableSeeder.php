<?php

use Illuminate\Database\Seeder;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tools')->insert([
            'name' => 'PAK',
            'logo' => 'images/logo_pak.png',
            'youtube' => 'ttd3hNNxfZw',
            'link' => 'http://45.77.43.67/new.rar',
            'updated' => true,
            'active' => true,
            'cost' => '{"24":"28000","168":"150000","720":"400000"}',
            'package' => '{"24":"28000","168":"150000","720":"400000"}',
            'reseller' => '{"24":"28000","168":"150000","720":"400000"}',
            'description' => 'Tiếng Việt 100% chơi được tất cả các phiên bản. Có ESP, AIM. An toàn 99%',
            'content' => 'Hướng dẫn cài đặt',
            'order' => 10,
            'game_id' => 1,
            'showcase' => 'PzDMtE9n6pA'
        ]);

        DB::table('tools')->insert([
            'name' => 'CR',
            'logo' => 'images/tool_cr.png',
            'youtube' => 'ttd3hNNxfZw',
            'link' => 'http://google.com',
            'updated' => true,
            'active' => true,
            'cost' => '{"24":"28000","168":"150000","720":"400000"}',
            'package' => '{"24":"28000","168":"150000","720":"400000"}',
            'reseller' => '{"24":"28000","168":"150000","720":"400000"}',
            'description' => '',
            'content' => 'Tiếng Anh, chỉ chơi bản Quốc tế. Có ESP, AIM và các chức năng nâng cao. An toàn 70%',
            'order' => 20,
            'game_id' => 2,
            'showcase' => 'PzDMtE9n6pA'
        ]);

        DB::table('tools')->insert([
            'name' => 'Z',
            'logo' => 'images/tool_tn.png',
            'youtube' => 'ttd3hNNxfZw',
            'link' => 'http://google.com',
            'updated' => false,
            'active' => false,
            'cost' => '{"24":"28000","168":"150000","720":"400000"}',
            'package' => '{"24":"28000","168":"150000","720":"400000"}',
            'reseller' => '{"24":"28000","168":"150000","720":"400000"}',
            'description' => 'Tiếng Anh, chỉ chơi bản Quốc tế. Có ESP, AIM và các chức năng nâng cao. An toàn 70%',
            'content' => 'Tiếng Anh, chỉ chơi bản Quốc tế. Có ESP, AIM và các chức năng nâng cao. An toàn 70%',
            'order' => 30,
            'game_id'=>3,
            'showcase' => 'PzDMtE9n6pA'
        ]);
    }
}
