<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('files', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        Schema::table('files', function($table) {
            $table->foreign('form_id')->references('id')->on('forms');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('password_resets');
	}

}
