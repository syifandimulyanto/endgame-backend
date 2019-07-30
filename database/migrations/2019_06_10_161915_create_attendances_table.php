<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancesTable extends Migration {

	public function up()
	{
		Schema::create('attendances', function(Blueprint $table) {
			$table->char('id', 36)->primary();
			$table->char('student_schedule_id', 36);
			$table->datetime('date');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('attendances');
	}
}