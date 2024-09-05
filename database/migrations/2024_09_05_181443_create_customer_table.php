<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('customerID'); // Use 'id' for auto-incrementing primary key
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('contact', 20);
            $table->string('gender', 10);
            $table->string('houseNo', 50);
            $table->string('streetName');
            $table->string('city', 100);
            $table->string('postalCode', 20);
            $table->longText('image')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
};
