<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('audit_id')->unsigned()->nullable();

            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->char('mobile_number', 20)->nullable();

            $table->string('password');

            $table->char('pattern', 20)->nullable();

            $table->integer('number_of_attemps')->default(0);

            $table->dateTime('recovery_date')->nullable();

            $table->boolean('lock_status')->nullable()->default(false);

            $table->boolean('active_status')->default(true);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
