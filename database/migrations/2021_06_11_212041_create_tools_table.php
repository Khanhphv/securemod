<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('logo', 191);
            $table->text('images');
            $table->string('link', 191);
            $table->string('link_backup', 255)->nullable();
            $table->string('description_eng', 500);
            $table->text('content_eng');
            $table->string('youtube', 255);
            $table->integer('game_id');
            $table->string('video_intro', 191);
            $table->tinyInteger('updated');
            $table->tinyInteger('active');
            $table->string('cost', 191)->nullable();
            $table->string('package', 191);
            $table->string('reseller', 191)->nullable();
            $table->text('error_code')->nullable();
            $table->string('mode', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('abstract');
            $table->text('content')->nullable();
            $table->string('showcase', 255);
            $table->integer('order');
            $table->string('author', 191)->nullable();
            $table->text('api_get_key')->nullable();
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
