<?php

use Illuminate\Database\Seeder;

class MasterSiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_site_settings')->insert([
            'logo_mini' => '/images/logo/logo_mini.png',
            'text_logo' => '/images/logo/logo.png',
            'favicon' => '/favicon.ico',
            'about_us' => 'SecureCheats is now about 3 years old since it was founded - our team of coders are professional and are specialized in many aspects in programming, reverse engineering, exploiting and have made many cheats/hacks/exploits in almost all game engines out there! ',
            'for_support' => 'support@securecheat.xyz',
            'verified_seller_logo' => '/images/logo/verified_logo.png',
            'verified_seller_url' => 'https://www.elitepvpers.com/'
        ]);
    }
}
