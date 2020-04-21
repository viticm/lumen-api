<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar = 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
        $password = '$2a$08$n6psiN6VUPu5yDUDSN8PxuKiIMClo0YnPkBwuXtaLQeAGY7Xm8h1y';
        $email = 'leafly.ti@hotmail.com';
        $username = 'leafly';
        $row = User::where('email', $email)->orWhere('username', $username)->first();
        if (!is_null($row)) return;
        $user = new User();
        $user->email = $email;
        $user->username = $username;
        $user->roles = '["admin"]';
        $user->password = $password;
        $user->avatar = $avatar;
        $user->save();
    }
}
