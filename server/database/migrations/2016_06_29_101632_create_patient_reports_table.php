<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreatePatientReportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('patientreports',function(Blueprint $table){
            $table->increments("id");
            $table->integer("patients_id")->references("id")->on("patients");
            $table->integer("customers_id")->references("id")->on("customers");
            $table->enum("report_reason", ["Balance", "Behavior", "Both"]);
            $table->decimal("balance_amount", 15, 2);
            $table->date("service_date");
            $table->integer("behaviorlists_id")->references("id")->on("behaviorlists");
            $table->text("note")->nullable();
            $table->date("report_date");
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
        Schema::drop('patientreports');
    }

}