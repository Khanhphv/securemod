<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_site_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo_mini')->default('/images/logo/logo_mini.png');
            $table->string('text_logo')->default('/images/logo/logo.png');
            $table->string('favicon')->default('/favicon.ico');
            $table->string('about_us')->nullable();
            $table->string('for_support')->nullable();
            $table->string('verified_seller_logo')->default('/images/logo/verified_logo.png');
            $table->string('verified_seller_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_site_settings');
    }
}
