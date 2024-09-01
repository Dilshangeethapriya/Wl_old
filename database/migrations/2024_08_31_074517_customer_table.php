<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->customerID();
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
