<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateSiteSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('sitesettings',function(Blueprint $table){
            $table->increments("id");
            $table->string("logo");
            $table->string("contact_mail");
            $table->string("admin_email");
            $table->text("contact_address");
            $table->string("contact_no")->nullable();
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
        Schema::drop('sitesettings');
    }

}