<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('callback_requests', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('phone');
            $table->time('time_from');
            $table->time('time_to');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('callback_requests');
    }
};
