<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchedulesTable extends Migration {

	public function up()
	{
		Schema::create('schedules', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuid('course_id');
			$table->uuid('lecture_id');
			$table->uuid('room_id');
			$table->uuid('class_id');
			$table->enum('period', array('ganjil', 'genap'));
			$table->integer('period_year');
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('day');
			$table->time('start_time');
			$table->time('end_time');
			$table->timestamps();
			$table->softDeletes();

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('lecture_id')->references('id')->on('lecturers');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('class_id')->references('id')->on('classes');
		});
	}

	public function down()
	{
		Schema::drop('schedules');
	}
}