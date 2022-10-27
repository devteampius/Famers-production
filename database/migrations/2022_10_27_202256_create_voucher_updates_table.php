<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vou_number');

            $table->string("old_paid_status")->nullable();
            $table->string("old_paid_amt")->nullable();
            $table->string("old_paid_date")->nullable();

            $table->string("rl_paid_status")->nullable();
            $table->string("rl_paid_amt")->nullable();
            $table->string("rl_paid_date")->nullable();

            $table->string("cm_paid_status")->nullable();
            $table->string("cm_paid_amt")->nullable();
            $table->string("cm_paid_date")->nullable();

            $table->integer("userid");
            $table->enum("status",["open","process","resolved"])->default("open");
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
        Schema::dropIfExists('voucher_updates');
    }
}
