<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
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
        User::truncate();

        DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first()->id;
        $authorRole = Role::where('name','author')->first()->id;
        $userRole = Role::where('name','user')->first()->id;

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);

        $profileAdmin = Profile::create([
            'user_id' => $admin->id,
            'image' => 's.png',
            'birthday' => '01/01/2000',
            'phone' => '0969123123',
            'address' => 'Ha Noi',
            'link' => '',
            'nickname' => 'adminuser'
        ]);

        $author = User::create([
            'name' => 'Author User',
            'email' => 'author@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);

        $profileAuthor = Profile::create([
            'user_id' => $author->id,
            'image' => 's.png',
            'birthday' => '01/01/2000',
            'phone' => '0969123123',
            'address' => 'Ha Noi',
            'link' => '',
            'nickname' => 'authoruser'
        ]);
        $user = User::create([
            'name' => 'User User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);

        $profileUser = Profile::create([
            'user_id' => $user->id,
            'image' => 's.png',
            'birthday' => '01/01/2000',
            'phone' => '0969123123',
            'address' => 'Ha Noi',
            'link' => '',
            'nickname' => 'useruser'
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
