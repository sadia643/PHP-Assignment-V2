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
            $table->string('ISO_3166-1');
			$table->string('country_name');
            $table->timestamps();
        });
		DB::table('countries')->insert([
			['ISO_3166-1' => 'usa', 'country_name' => 'United States'],
			['ISO_3166-1' => 'gbr', 'country_name' => 'United Kingdom'],
			['ISO_3166-1' => 'def', 'country_name' => 'Other countries/default values']
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
