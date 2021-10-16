<?php

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
        User::create([
           'username' => 'admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make('admin'),
       ]);

        User::create([
           'username' => 'user',
           'email' => 'user@user.com',
           'password' => Hash::make('user'),
       ]);

        User::create([
            'username' => 'pedro',
            'email' => 'pedro@gmail.com',
            'password' => Hash::make('pedro'),
        ]);

        User::create([
            'username' => 'josé',
            'email' => 'jose@gmail.com',
            'password' => Hash::make('jose'),
        ]);

        User::create([
            'username' => 'marcos',
            'email' => 'marcos@outlook.com',
            'password' => Hash::make('marcos'),
        ]);
    }
}
