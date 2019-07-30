<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentSchedulesTable extends Migration {

	public function up()
	{
		Schema::create('student_schedules', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuid('student_id');
			$table->uuid('schedule_id');
			$table->timestamps();
			$table->softDeletes();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('schedule_id')->references('id')->on('schedules');
		});
	}

	public function down()
	{
		Schema::drop('student_schedules');
	}
}