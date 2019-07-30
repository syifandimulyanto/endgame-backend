<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuid('program_study_id');
			$table->string('code', 32)->unique();
			$table->string('name', 126);
			$table->integer('sks');
			$table->integer('semester');
			$table->integer('curriculum');
			$table->enum('status', array('active', 'inactive'));
			$table->timestamps();
			$table->softDeletes();

            $table->foreign('program_study_id')->references('id')->on('program_studies');
		});
	}

	public function down()
	{
		Schema::drop('courses');
	}
}