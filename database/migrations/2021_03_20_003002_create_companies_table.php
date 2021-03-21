<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('audit_id')->unsigned()->nullable();

            $table->string('name');

            $table->string('registry_number')->nullable();

            $table->string('address')->nullable();

            $table->integer('latitud_number')->nullable();

            $table->integer('longitude_number')->nullable();

            $table->string('mobile_number')->nullable();

            $table->string('phone_number')->nullable();

            $table->string('email')->nullable();

            $table->integer('country_code')->nullable();

            $table->boolean('branch_status');

            $table->boolean('active_status');

            //$table->timestamps();

            $table->foreign('audit_id')->references('id')->on('audits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
