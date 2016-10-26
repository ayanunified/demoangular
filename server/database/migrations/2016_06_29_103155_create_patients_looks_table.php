<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreatePatientsLooksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('patientslooks',function(Blueprint $table){
            $table->increments("id");
            $table->string("first_name")->nullable();
            $table->string("middle_name")->nullable();
            $table->string("last_name")->nullable();
            $table->date("dob")->nullable();
            $table->string("ssn")->nullable();
            $table->string("gender")->nullable();
            $table->integer("customers_id")->references("id")->on("customers")->nullable();
            $table->string("found_match")->nullable();
            $table->string("patient_ids")->nullable();
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
        Schema::drop('patientslooks');
    }

}