<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentScheduleChangesTable extends Migration {

	public function up()
	{
		Schema::create('student_schedule_changes', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuid('schedule_id');
			$table->uuid('room_id');
			$table->date('date');
			$table->time('start_time');
			$table->time('end_time');
			$table->timestamps();
			$table->softDeletes();

            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('room_id')->references('id')->on('rooms');
		});
	}

	public function down()
	{
		Schema::drop('student_schedule_changes');
	}
}