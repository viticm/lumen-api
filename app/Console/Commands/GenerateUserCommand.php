<?php
/**
 * Lumen-api ( https://github.com/viticm/lumen-api )
 * $Id GenerateUserCommand.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2014- viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm<viticm.ti@gmail.com>
 * @date 2020/04/15 09:55
 * @uses The generate admin user command.
*/

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hautelook\Phpass\PasswordHash;
use App\Models\User;

class GenerateUserCommand extends Command
{

    /**
     * 命令名称
     *
     * @var string
     */
    protected $signature = 'gen_user {email} {username} {password} {role}';

    /**
     * 命令描述
     *
     * @var string
     */
    protected $description = 'Generate or update a user of admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 命令执行处理函数
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $username = $this->argument('username');
        $password = $this->argument('password');
        echo 'email: ' . $email . ' user: ' . $username . ' pass: ' . $password . "\n";
        $row = User::where('username', $username)
            ->orWhere('email', $email)->first();
        $passwordHasher = new PasswordHash(8, false);
        $encrypt_password = $passwordHasher->HashPassword($password);
        $showtime = date("Y-m-d H:i:s");
        // $role = json_encode(explode(':', $this->argument('role')));
        $role = $this->argument('role');
        echo 'show time: ' . $showtime . "\n";
        $id = -1;
        if ($row !== null) {
            // echo "en: " . $encrypt_password . "\n";
            echo 'user: ' . $username . ' update to: ' . $password . "\n";
            $row->password = $encrypt_password;
            $row->role = $role;
            print_r($row->updated_at);
            $row->save();
            $id = $row->id;
        } else {
            $avatar = 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
            if (strpos($role, 'admin') !== false)
                $avatar = 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
            $user = new User();
            $user->email = $email;
            $user->username = $username;
            $user->role = $role;
            $user->password = $encrypt_password;
            $user->avatar = $avatar;
            if (false === $user->save()) {
                echo 'user: ' . $username . ' generate failed.' . "\n";
            } else {
                echo 'user: ' . $username . ' generate succeed.' . "\n";
            }
            $id = $user->id;
        }
        echo 'user id: ' . $id . "\n";
    }

}
