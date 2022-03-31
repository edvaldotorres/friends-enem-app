<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSchedulesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class_schedules', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('discipline');
			$table->timestamp('start_timestamp');
			$table->timestamp('end_timestamp');
			$table->string('vacancie');
			$table->boolean('status')->default(false);

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
		Schema::drop('class_schedules');
	}
}
