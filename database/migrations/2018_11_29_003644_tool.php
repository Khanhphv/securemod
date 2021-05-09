<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('game_id')->default(1);
            $table->string('name');
            $table->string('logo');
            $table->string('link');
            $table->string('link_backup')->nullable();
            $table->string('youtube');
            $table->boolean('updated')->default(true);
            $table->boolean('active')->default(true);
            $table->string('cost')->nullable();
            $table->string('package');
            $table->string('reseller');
            $table->string('description')->nullable();
            $table->string('description_eng')->nullable();
            $table->text('content')->nullable();
            $table->text('content_eng')->nullable();
            $table->integer('order')->default(99);
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
        Schema::dropIfExists('tools');
    }
}
