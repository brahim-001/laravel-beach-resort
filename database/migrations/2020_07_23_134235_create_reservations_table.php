<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->string('room_name');
            $table->date('checkin')->format('dd/mm/YY');
            $table->date('checkout')->format('dd/mm/YY');
            $table->float('number_of_nights');
            $table->float('total_price');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->ondelete('cascade'); 
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}