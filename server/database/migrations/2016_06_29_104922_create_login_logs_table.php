<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateLoginLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('loginlogs',function(Blueprint $table){
            $table->increments("id");
            $table->integer("customers_id")->references("id")->on("customers");
            $table->dateTime("login_time");
            $table->dateTime("logout_time");
            $table->string("patients_ids")->nullable();
            $table->string("patients_search_id")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('loginlogs');
    }

}