<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('fields', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->string('name');
            $table->boolean('required');
            $table->timestamps();
        });

        Schema::table('fields', function($table) {
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
		Schema::drop('fields');
	}

}
