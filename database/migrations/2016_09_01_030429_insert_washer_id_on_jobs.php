<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertWasherIdOnJobs extends Migration
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
            $table->integer('washer_id')->nullable()->index()->unsigned()->after('id');
            $table->integer('dryer_id')->nullable()->index()->unsigned()->after('washer_id');
            $table->dropColumn('machine_id');
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
            $table->dropColumn(['washer_id', 'dryer_id']);
            $table->integer('machine_id')->index()->unsigned()->nullable()->after('id');
        });
    }
}
