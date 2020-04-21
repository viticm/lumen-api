<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

// This is client test list.
global $list;
$list = "
[
    {
        \"key\": \"admin\",
        \"name\": \"admin\",
        \"description\": \"Super Administrator. Have access to view all pages.\",
        \"routes\": \"\"
    },
    {
        \"key\": \"editor\",
        \"name\": \"editor\",
        \"description\": \"Normal Editor. Can see all pages except permission page\",
        \"routes\": \"\"
    },
    {
        \"key\": \"visitor\",
        \"name\": \"visitor\",
        \"description\": \"Just a visitor. Can only see the home page and the document page\",
        \"routes\": \"\"
    }
]
";

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        global $list;
        $data = json_decode($list, true);
        foreach ($data as $one) {
            $row = Role::where('key', $one['key'])->first();
            if (!is_null($row)) continue;
            $role = new Role();
            $role->key = $one['key'];
            $role->name = $one['name'];
            $role->description = $one['description'];
            $role->routes = $one['routes'];
            $role->save();
        }
    }
}
