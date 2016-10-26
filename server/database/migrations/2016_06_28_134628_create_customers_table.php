<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateCustomersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('customers',function(Blueprint $table){
            $table->increments("id");
            $table->string("legalName");
            $table->string("dbaName");
            $table->integer("businesses_id")->references("id")->on("businesses");
            $table->string("tad_id");
            $table->text("address");
            $table->string("suite");
            $table->string("city");
            $table->string("state");
            $table->string("country");
            $table->string("office_phone");
            $table->string("email");
            $table->string("website")->nullable();
            $table->string("noOfDoc")->nullable();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("cell_phone");
            $table->string("username");
            $table->string("password");
            $table->enum("status", ["Active", "Inactive", "PassDue"]);
            $table->date("expiry_date");
            $table->enum("membership_type", ["Trial", "Monthly", "Yearly", "Lifetime"]);
            $table->string("sales_person_id")->nullable();
            $table->string("refer_id")->nullable();
            $table->string("refer_chanel")->nullable();
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
        Schema::drop('customers');
    }

}