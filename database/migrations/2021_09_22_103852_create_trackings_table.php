<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('case_number', 32);
            $table->string('shipment_provider', 16);
            $table->string('shipment_tracking_number', 64);
            $table->text('tracking_history');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
    }
}
