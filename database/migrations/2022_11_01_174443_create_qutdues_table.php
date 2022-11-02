<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQutduesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qutdues', function (Blueprint $table) {
            $table->increments('id');
            $table->string("order_no");

            $table->string("old_qty_due")->nullable();

            $table->string("rl_qty_due")->nullable();

            $table->string("cm_qty_due")->nullable();


            $table->integer("userid");
            $table->enum("db_status",["verify","rollback","commit"]);
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
        Schema::dropIfExists('qutdues');
    }
}
