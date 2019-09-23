<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hour')->nullable();
            $table->string('address')->nullable();
            $table->string('amount_people')->default(1);
            $table->string('additional_comments')->nullable();
            $table->integer('total_charge')->nullable();
            $table->integer('type_order')->nullable(); # 1)Inmediata 2)Programada
            $table->integer('type_pay')->nullable(); # 1)Contraentrega 2)Transferencia

            #para las ordenes programadas
            $table->boolean("isSchedule")->default(false); #¿es una orden agendada?
            $table->integer("modality")->nullable();#1)en casa del chef 2) chef en casa
            $table->string("chance")->nullable();
            $table->string("food_type")->nullable();

            $table->integer("status")->default(0); #0 sin validar #1 aprovada #2 rechazada

            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('chef_id')->nullable();
            $table->unsignedBigInteger('diner_id');
            $table->integer('domiciliary');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
