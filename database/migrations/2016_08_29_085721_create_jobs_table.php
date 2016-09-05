<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->enum('service_type', ['self', 'employee'], 'self')->nullable();
            $table->enum('kilogram', ['8', '16'])->nullable();
            $table->enum('washer_mode', ['clean', 'cleaner', 'cleanest'])->nullable();
            $table->enum('dryer_mode' , ['19', '24' , '29'])->nullable();
            $table->enum('detergent', ['ariel', 'pride', 'tide', 'i_have_one'])->nullable();
            $table->enum('bleach', ['colorsafe', 'original', 'i_have_one'])->nullable();
            $table->enum('fabric_conditioner', ['downy', 'i_have_one'])->nullable();
            $table->boolean('is_press')->default(false);
            $table->boolean('is_fold')->default(false);
            $table->enum('status', ['pending', 'reserved', 'approved', 'declined', 'done', 'expired'], 'pending')->default('pending');
            $table->timestamp('reserve_at')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
