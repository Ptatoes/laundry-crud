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
        // Check if the column does not exist before adding it
        if (!Schema::hasColumn('orders', 'price')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->decimal('price', 12, 2)->nullable(); // Adjust type and precision as needed
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('price'); // This will drop the column when rolling back
        });
    }
};
