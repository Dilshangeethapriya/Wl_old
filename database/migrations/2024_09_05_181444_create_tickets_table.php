
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticketID');
            $table->unsignedBigInteger('customerID')->nullable(); // Foreign key for registered customers
            $table->string('name')->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->string('subject')->nullable(); 
            $table->string('ticketType', 50)->nullable(); 
            $table->text('ticketText')->nullable(); 
            $table->string('ticketStatus', 50)->nullable(); 
            $table->timestamps(); // Creates `created_at` and `updated_at`

            // Define foreign key constraint if the customer table exists
            $table->foreign('customerID')->references('customerID')->on('customer')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}