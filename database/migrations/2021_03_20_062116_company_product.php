<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_product', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('audit_id')->unsigned();

            $table->bigInteger('company_id')->unsigned();

            $table->bigInteger('product_id')->unsigned();

            $table->boolean('in_original')->default(true);

            $table->integer('original_stock_number')->unsigned()->nullable();

            $table->boolean('in_replacement')->default(true);

            $table->integer('replacement_stock_number')->unsigned()->nullable();

            $table->boolean('status')->default(true);

            //quitar
            //$table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
