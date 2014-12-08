<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('submission_data', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('submission_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->text('data');
            $table->timestamps();
        });

        Schema::table('submission_data', function($table) {
            $table->foreign('submission_id')->references('id')->on('form_submissions');
            $table->foreign('field_id')->references('id')->on('fields');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::down('submission_data');
	}

}
