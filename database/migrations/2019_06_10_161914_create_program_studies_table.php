<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramStudiesTable extends Migration {

	public function up()
	{
		Schema::create('program_studies', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('code', 32)->unique();
			$table->string('name', 126);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('program_studies');
	}
}