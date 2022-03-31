<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDisciplinesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_disciplines', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');

			$table->unsignedBigInteger('discipline_id');
			$table->foreign('discipline_id')->references('id')->on('disciplines');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_disciplines');
	}
}
