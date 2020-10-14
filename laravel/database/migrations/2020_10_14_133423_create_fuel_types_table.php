<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFuelTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_types', function (Blueprint $table) {
            $table->id();
			$table->string('types');
            $table->timestamps();
        });
		DB::table('fuel_types')->insert([
            ['types' => 'motorGasoline '],
            ['types' => 'diesel'],
            ['types' => 'aviationGasoline'],
			['types' => 'jetFuel'],
			['types' => 'petrol'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_types');
    }
}
