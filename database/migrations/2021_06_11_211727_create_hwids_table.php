<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwids', function (Blueprint $table) {
            $table->id();
            $table->string('hwid', 191);
            $table->string('key', 191)->nullable();
            $table->string('cheat_name', 191);
            $table->string('time', 191);
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
        Schema::dropIfExists('hwids');
    }
}
