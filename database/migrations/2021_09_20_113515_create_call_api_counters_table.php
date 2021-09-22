<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallApiCountersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('call_api_counters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('api_provider', 32);
            $table->date('date');
            $table->integer('counter')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('call_api_counters');
    }
}
