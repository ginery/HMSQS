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
        if (Schema::hasTable('reservation')) {
            Schema::dropIfExists('reservation');
        }
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();           
            $table->integer('user_id');
            $table->integer('room_id');
            $table->integer('service_id');
            $table->string('pax');
            $table->string('total_amount');
            $table->string('terms');
            $table->dateTime('checkin_date')->nullable();
            $table->dateTime('checkout_date')->nullable();;
            $table->integer('status');
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
        Schema::dropIfExists('reservation');
    }
};
