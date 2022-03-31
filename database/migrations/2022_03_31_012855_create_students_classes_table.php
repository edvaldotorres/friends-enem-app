<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsClassesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students_classes', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');

			$table->unsignedBigInteger('class_schedule_id');
			$table->foreign('class_schedule_id')->references('id')->on('class_schedules');

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
		Schema::drop('students_classes');
	}
}
