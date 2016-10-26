<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreatePaymentReportTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('paymentreport',function(Blueprint $table){
            $table->increments("id");
            $table->integer("customers_id")->references("id")->on("customers");
            $table->string("transaction_id");
            $table->decimal("amount_paid", 15, 2);
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
        Schema::drop('paymentreport');
    }

}