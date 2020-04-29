<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dev_times', function (Blueprint $table) {
            $table->timestamp('started')->nullable();
            $table->timestamp('time-frame')->nullable();
            $table->timestamp('finished')->nullable();
            $table->integer('client_id')->unsigned()->index();
             $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dev_times');
    }
}
