<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_histories', function (Blueprint $table) {
            $table->id();
            $table->string('site_code');
            $table->string('factory_code');
            $table->float('ph');
            $table->float('flow');
            $table->float('total_debit');
            $table->float('total_credit');
            $table->timestamps();

            // Indexes for optimizing queries
            $table->index('site_code');
            $table->index('factory_code');
            $table->index('ph');
            $table->index('flow');
            $table->index('total_debit');
            $table->index('total_credit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_histories');
    }
}
