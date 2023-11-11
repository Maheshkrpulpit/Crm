<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('api_id')->nullable();
            $table->string('tx_ref');
            $table->string('api_ref')->nullable();
            $table->enum('type',['membership','register','admission','other','exam']);
            $table->unsignedBigInteger('item_id')->nullable();

            $table->string('ip');

            $table->float('amount',16,2);
            $table->float('charged_amount',16,2)->nullable();

            $table->string('currency')->nullable();
            $table->string('status');
            $table->json('response')->nullable();
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
};
