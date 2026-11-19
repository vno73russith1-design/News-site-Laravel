<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'user']);
        Role::create(['name' => 'journalist']);
        Role::create(['name' => 'admin']);

        Category::create(['name' => 'Технологии']);
        Category::create(['name' => 'Наука']);
        Category::create(['name' => 'Космос']);

        User::create([
            'login' => 'admin',
            'password' => Hash::make('admin123'),
            'role_id' => 3,
        ]);

        User::create([
            'login' => 'journalist',
            'password' => Hash::make('journalist123'),
            'role_id' => 2,
        ]);
    }
}