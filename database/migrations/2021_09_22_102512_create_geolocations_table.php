<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeolocationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('geolocations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city', 64)->nullable();
            $table->string('state', 64)->nullable();
            $table->string('zip_code', 12)->nullable();
            $table->text('geocoding');
            $table->unique(['city', 'state', 'zip_code']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
        Schema::dropIfExists('geolocations');
    }
}
