<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id');
            $table->date('order_date');
            $table->decimal('weight', 8, 2);
            $table->string('status');
            $table->date('date_taken')->nullable(); // Allow date_taken to be nullable
            $table->boolean('laundry_not_taken')->default(false); // Add this for the checkbox
            $table->timestamps();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
