<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footprints', function (Blueprint $table) {
			$table->id();
            $table->integer('activity');
			$table->string('activityType');
			$table->string('fuelType')->nullable();
			$table->string('mode')->nullable();
			$table->string('country');
			$table->string('appTkn')->nullable();		
			$table->json('carbonFootprint')->nullable();
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
        Schema::dropIfExists('footprints');
    }
}
