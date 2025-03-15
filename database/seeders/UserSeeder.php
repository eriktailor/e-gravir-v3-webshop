<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Erik Tailor',
            'email' => 'erno22szabo@gmail.com',
            'image' => '/img/admin/erik.jpg'
        ], [
            'password' => Hash::make('szabo6404ERNO')
        ]);

        User::firstOrCreate([
            'name' => 'Bohó Barbara',
            'email' => 'barbaraboho6@gmail.com',
            'image' => '/img/admin/barbi.jpeg'
        ], [
            'password' => Hash::make('boho1234BARBARA')
        ]);
    }
}
