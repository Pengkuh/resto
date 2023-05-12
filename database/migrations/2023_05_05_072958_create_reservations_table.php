<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('res_id');
            // user
            $table->string('res_name_user');
            $table->string('res_phone_user');
            $table->string('res_email_user');
            // res table
            $table->string('res_table_name');
            $table->string('res_table_price');
            $table->string('res_table_category');
            // product
            $table->string('res_product_name');
            $table->string('res_product_price');
            $table->string('res_product_category');
            // payment
            $table->string('res_method_payment');
            $table->string('res_name_payment');
            $table->string('res_code_payment');

            // status
            $table->string('res_status');


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
        Schema::dropIfExists('reservations');
    }
};
