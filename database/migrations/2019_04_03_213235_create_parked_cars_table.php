<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkedCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parked_cars', function (Blueprint $table) {
            $table->increments('car_id');
            $table->string('car_status')->default('parked');
            $table->integer('ticket_number')->unique();
            $table->integer('ticket_created_at');
            $table->integer('paid_amount')->default(0);
            $table->string('paid_credit_card')->default('');
            $table->integer('paid_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parked_cars');
    }
}
