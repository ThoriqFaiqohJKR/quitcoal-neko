<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AccountInsertSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('accounts')->insert([
            [
                'nama' => 'quitcoal Admin',
                'email' => 'quitcoal@auriga.or.id',
                'password' => Hash::make('123123'),
                'password_text' => '123123',
                'role' => 'admin',
                'status' => 'Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'super neko',
                'email' => 'neko@auriga.or.id',
                'password' => Hash::make('123thor'),
                'password_text' => '123thor',
                'role' => 'admin',
                'status' => 'Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}