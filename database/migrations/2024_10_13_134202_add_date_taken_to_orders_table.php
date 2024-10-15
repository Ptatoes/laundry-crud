<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateTakenToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->date('date_taken')->nullable(); // Allow date_taken to be nullable

        });
    }
    

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('date_taken'); // Drop the date_taken column if rolling back
        });
    }
}



