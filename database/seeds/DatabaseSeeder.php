<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(ToolsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(MasterSiteSettingsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostTagTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(PaypalSellersTableSeeder::class);
        $this->call(HeadTagsTableSeeder::class);
        $this->call(LikePostTableSeeder::class);
    }
}
