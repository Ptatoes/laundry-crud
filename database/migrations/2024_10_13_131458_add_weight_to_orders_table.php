<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightToOrdersTable extends Migration
{
    public function up()
    {
        // Check if the column doesn't exist before adding it
        if (!Schema::hasColumn('orders', 'weight')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->decimal('weight', 8, 2)->nullable();
            });
        }
    }

    public function down()
    {
        // Drop the column if rolling back
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'weight')) {
                $table->dropColumn('weight');
            }
        });
    }
}

