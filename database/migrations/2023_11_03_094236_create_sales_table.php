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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id');
            $table->tinyInteger('brand_id');
            $table->tinyInteger('package_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_number');
            $table->string('alternate_mobile_number')->nullable();
            $table->string('social_security_number')->nullable();
            $table->string('date_of_birth');
            $table->string('prospect')->nullable();
            $table->string('source')->nullable();
            $table->string('email');
            $table->string('order_status');
            $table->tinyInteger('state_id');
            $table->string('zip_code');
            $table->text('previous_address')->nullable();
            $table->text('street_address')->nullable();
            $table->text('full_address');
            $table->string('city');
            $table->string('screen_shot')->nullable();
            $table->string('audio')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
