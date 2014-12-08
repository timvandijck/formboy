<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSubmissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('form_submissions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('form_submissions', function($table) {
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
		Schema::drop('form_submissions');
	}

}
