<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
             'name'=>'admin name',
             'username'=>'admin username',
             'email'=>'admin@gmail.com',
             'password'=> Hash::make('123456789'),
             'role_id'=> 1,

        ]);
    }
}
