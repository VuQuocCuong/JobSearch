<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('full_name', 255);
            $table->string('email', 255)->nullable();
            $table->string('website', 125)->nullable();
            $table->string('mobile', 11)->nullable();
            $table->longText('description')->nullable();
            $table->string('job_title', 255)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unique('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cvs');
    }
}
