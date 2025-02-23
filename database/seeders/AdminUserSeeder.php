<?php

namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

	$adminExists = User::where('email', 'admin@videoGames.com')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@videoGames.com',
                'password' => Hash::make('adminpassword123'), //Set the admin default password here 
                'role' => 'admin',  
            ]);
        }


    }
}
