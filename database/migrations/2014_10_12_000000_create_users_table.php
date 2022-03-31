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
            $table->string('nickname')->nullable();
            $table->string('document', 11)->unique()->comment('cpf')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('genre')->comment('Man, Woman, Both, None, Preferred not to inform')->nullable();
            $table->string('zipcode', 8)->nullable();

            // teacher
            $table->boolean('teacher_admin')->default(false)->comment('true, false')->nullable();
            $table->boolean('teacher')->default(false)->comment('true, false')->nullable();
            $table->string('graduation')->comment('Graduating, Graduate, Specialist, Mastering, Teacher, PhD student, Doctor, Post-Doctoral, Post-Doctor')->nullable();
            $table->string('telephone', 11)->nullable();
            $table->boolean('whatsapp')->default(false)->comment('true, false')->nullable();

            // student
            $table->string('color_declaration')->comment('Afrodescendant, Indigenous, Yellow, Black1, White, Black2, Brown')->nullable();
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
