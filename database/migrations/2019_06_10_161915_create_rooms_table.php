    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration {

	public function up()
	{
		Schema::create('rooms', function(Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('name', 64);
			$table->text('description')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('rooms');
	}
}