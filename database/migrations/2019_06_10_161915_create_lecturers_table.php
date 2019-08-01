<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLecturersTable extends Migration {

	public function up()
	{
		Schema::create('lecturers', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('nidn', 126)->unique();
			$table->string('nip', 126)->unique();
			$table->text('address')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('lecturers');
	}
}