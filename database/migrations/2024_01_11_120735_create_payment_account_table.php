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
        Schema::create('payment_account', function (Blueprint $table) {
            $table->id();
            $table->text('account_name');
            $table->text('account_holder_name');
            $table->text('account_number');
            $table->text('image');
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
        Schema::dropIfExists('payment_account');
    }
};
