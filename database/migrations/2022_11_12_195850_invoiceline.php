<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invoiceline extends Migration
{
    /**   
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('invoiceline', function (Blueprint $table) {
            $table->increments('id');

            $table->string("user_id");
            $table->string("from_invoice_dt")->nullable();
            $table->string("to_invoice_dt")->nullable();


            $table->enum("db_status",["entered"]);
            $table->integer("userid");


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
        Schema::dropIfExists('invoiceline');
    }
}
