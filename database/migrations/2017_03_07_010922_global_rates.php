<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GlobalRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('metal_rate', 3, 1);
            $table->decimal('crystal_rate', 3, 1);
            $table->decimal('energy_rate', 3, 1);
            $table->decimal('ship_build_time_rate', 3, 1);
            $table->decimal('ship_cost_rate', 3, 1);
            $table->decimal('building_build_time_rate', 3, 1);
            $table->decimal('building_cost_rate', 3, 1);
            $table->decimal('research_rate', 3, 1);
            $table->decimal('travel_rate', 3, 1);
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
        Schema::dropIfExists('global_rates');
    }
}
