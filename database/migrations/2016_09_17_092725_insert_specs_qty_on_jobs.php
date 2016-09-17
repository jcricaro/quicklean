<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSpecsQtyOnJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function(Blueprint $table)
        {
            $table->integer('detergent_qty')->default(1)->after('phone');
            $table->integer('bleach_qty')->default(1)->after('phone');
            $table->integer('fabric_conditioner_qty')->default(1)->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function(Blueprint $table)
        {
            $table->dropColumn(['detergent_qty', 'bleach_qty', 'fabric_conditioner_qty']);
        });
    }
}
