<?php

namespace Database\Seeders;

use App\Enums\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Professor Administrador',
            'email' => 'admin@admin.com.br',
            'email_verified_at' => now(),
            'password' => bcrypt('123Admin@admin'),
            'remember_token' => Str::random(10),
            'type' => UserType::TEACHER_ADMIN,
            'nickname' => 'Professor America',
            'document' => '12107219451',
            'birth_date' => '1999-12-01',
            'genre' => 1,
            'zipcode' => '01001000',
        ]);
    }
}
