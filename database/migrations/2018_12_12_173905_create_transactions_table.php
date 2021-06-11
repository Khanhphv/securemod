<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('action', 255);
            $table->float('amount');
            $table->integer('provider')->nullable();
            $table->integer('id_user_tt')->nullable();
            $table->string('seri', 191)->nullable();
            $table->string('pin', 191)->nullable();
            $table->string('status', 191)->nullable();
            $table->string('transaction_id', 191);
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
        Schema::dropIfExists('transactions');
    }
}
