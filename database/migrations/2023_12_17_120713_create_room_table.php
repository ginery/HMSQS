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
        if (Schema::hasTable('rooms')) {
            Schema::dropIfExists('rooms');
        }
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->string('room_type');
            $table->float('price');
            $table->string('description');
            $table->string('image');
            $table->timestamps();
            $table->integer('status')->unsigned()->default(0); //0 - active, 1 - inactive
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room');
    }
};
