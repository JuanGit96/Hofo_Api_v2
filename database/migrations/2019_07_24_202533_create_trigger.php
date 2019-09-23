<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::unprepared('
//        CREATE TRIGGER tr_Sale_Price BEFORE INSERT ON `menus` FOR EACH ROW
//            SET NEW.precio_venta = NEW.precio * 0.1
//        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::unprepared('DROP TRIGGER `tr_Sale_Price`');
    }
}
