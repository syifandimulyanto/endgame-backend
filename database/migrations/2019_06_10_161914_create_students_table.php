<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuid('program_study_id');
			$table->integer('nrp');
			$table->date('birth_date')->nullable();
			$table->string('birth_place', 126)->nullable();
			$table->enum('gender', array('male', 'female'));
			$table->string('religion', 64);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('program_study_id')->references('id')->on('program_studies');

		});
	}

	public function down()
	{
		Schema::drop('students');
	}
}