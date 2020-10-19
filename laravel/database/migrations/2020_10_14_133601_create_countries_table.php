<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_code');
			$table->string('country_name');
            $table->timestamps();
        });
		DB::table('countries')->insert([
			['country_code' => 'usa', 'country_name' => 'United States'],
			['country_code' => 'gbr', 'country_name' => 'United Kingdom'],
			['country_code' => 'def', 'country_name' => 'Other countries/default values']
        ]);
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
