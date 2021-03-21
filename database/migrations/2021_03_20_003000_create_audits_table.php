<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('audit_id')->unsigned()->nullable();

            $table->string('table_name');

            $table->bigInteger('row_code')->unsigned()->nullable();

            $table->string('operation_type_code');

            $table->string('statement');

            $table->string('error')->nullable();

            $table->bigInteger('user_id')->unsigned();

            $table->char('mac_code')->nullable();

            $table->string('ip_code')->nullable();

            $table->timestamps();

            $table->boolean('error_status')->default(false);

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
        Schema::dropIfExists('audits');
    }
}
