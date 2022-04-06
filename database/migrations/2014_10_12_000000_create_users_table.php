<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // access default
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // default
            $table->boolean('teacher')->default(false)->comment('true, false')->nullable();
            $table->string('nickname')->nullable();
            $table->string('document', 11)->unique()->comment('cpf')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('genre')->comment('1 = Man, 2 = Woman, 3 = Both, 4 = None, 5 = Preferred not to inform')->nullable();
            $table->string('zipcode', 8)->nullable();

            // teacher
            $table->boolean('teacher_admin')->default(false)->comment('true, false')->nullable();
            $table->integer('graduation')->comment('1 = Graduating, 2 = Graduate, 3 = Specialist, 4 = Mastering, 5 = Teacher, 6 = PhD student, 7 = Doctor, 8 = Post-Doctoral, 9 = Post-Doctor')->nullable();
            $table->string('telephone', 11)->nullable();
            $table->boolean('whatsapp')->default(false)->comment('true, false')->nullable();

            // student
            $table->integer('color_declaration')->comment('1 = Afrodescendant, 2 = Indigenous, 3 = Yellow, 4 = Black1, 5 = White, 6 = Black2, 7 = Brown')->nullable();
            $table->text('observation')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
