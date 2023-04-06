<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user::create([
            'name'=>'admin',
            'role'=>'admin',
            'email'=>'admin@mail.com',
            'password'=>Hash::make('123456'),
        ]);
    }
}
