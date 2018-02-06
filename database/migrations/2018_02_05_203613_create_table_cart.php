<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->integer('event_id')->unsigned();
            $table->integer('ticket_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('qtd');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('ticket_id')->references('id')->on('tickets');
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
        //
    }
}
