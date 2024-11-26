<?php

namespace Database\Seeders;

use App\Models\authz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [];
        foreach(config('authz.permissions') as $permission=>$value)
        {
            $permissions[] = $permission;
        }
        
        authz::create([
            'role'=>'Manager',
            'permissions' =>json_encode($permissions),
        ]);
    }
}
