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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticketID');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('subject', 50);
            $table->text('ticketText');
            $table->string('ticketStatus', 50)->default('new'); // Adjust status options as needed
            $table->timestamps();

            //$table->foreign('customerID')->references('customerID')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
