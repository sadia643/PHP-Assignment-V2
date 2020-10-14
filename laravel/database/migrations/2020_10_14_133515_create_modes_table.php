<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modes', function (Blueprint $table) {
            $table->id();
			$table->string('transportation');
            $table->timestamps();
        });
		DB::table('modes')->insert([
            ['transportation' => 'dieselCar'],
            ['transportation' => 'petrolCar'],
            ['transportation' => 'anyCar'],
			['transportation' => 'taxi'],
			['transportation' => 'economyFlight'],
			['transportation' => 'businessFlight'],
			['transportation' => 'firstclassFlight'],
			['transportation' => 'anyFlight'],
			['transportation' => 'motorbike'],
			['transportation' => 'bus'],
			['transportation' => 'transitRail'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modes');
    }
}
