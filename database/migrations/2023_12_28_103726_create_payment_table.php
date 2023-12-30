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
        if (Schema::hasTable('payment')) {
            Schema::dropIfExists('payment');
        }
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('book_id');
            $table->string('payment_type');
            $table->string('reference_number');
            $table->float('total_amount');
            $table->timestamps();
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
};
