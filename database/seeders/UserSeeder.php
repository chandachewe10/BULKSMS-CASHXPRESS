<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* create admin */
        /* password for these users is password */

        $factoryUsers = [
            [
                'name' => 'super-admin',
                'email' => 'admin@econnect.com',
                'senderId' => 'ADMIN',
                'password' => '$2y$10$dD8yarAAR8v75qt7ekre1utGJE7dA0PS2Ge5FLX9OkPxVBzMIBAcC', // test1234
                'role' => 'admin'
                
            ],

          

          
            
        ];

        foreach ($factoryUsers as $user) {
            $newUser =  User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'senderId' => $user['senderId'],
                'password' => $user['password'],
                
            ]);

           $newUser->assignRole($user['role']);
        }
    }
}
