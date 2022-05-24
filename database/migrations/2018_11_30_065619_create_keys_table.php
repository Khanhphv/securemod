<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tool_id')->unsigned();
            $table->string('key', 191);
            $table->string('package', 11);
            $table->string('mode', 50);
            $table->text('config')->nullable();
            $table->tinyInteger('sold')->nullable();
            $table->integer('history_id')->nullable();
            $table->string('hwid', 191)->nullable();
            $table->string('hwid_fixed', 255)->nullable();
            $table->integer('active_time')->nullable();
            $table->integer('hwid_count')->nullable();
            $table->integer('user_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keys');
    }
}
