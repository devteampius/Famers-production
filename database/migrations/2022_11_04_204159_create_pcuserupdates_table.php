<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcuserupdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcuserupdates', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id");

            $table->string("old_first_name")->nullable();
            $table->string("old_goes_by_name")->nullable();
            $table->string("old_last_name")->nullable();

            $table->string("rl_first_name")->nullable();
            $table->string("rl_goes_by_name")->nullable();
            $table->string("rl_last_name")->nullable();

            $table->string("cm_first_name")->nullable();
            $table->string("cm_goes_by_name")->nullable();
            $table->string("cm_last_name")->nullable();

            $table->enum("db_status",["verify","rollback","commit"]);
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
        Schema::dropIfExists('pcuserupdates');
    }
}
