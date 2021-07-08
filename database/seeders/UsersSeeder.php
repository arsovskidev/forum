<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->username = 'admin';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('admin');
        $admin->role_id = Role::where('type', 'admin')->first()->id;

        $member = new User();
        $member->username = 'member';
        $member->email = 'member@example.com';
        $member->password = Hash::make('member');
        $member->role_id = Role::where('type', 'member')->first()->id;

        $admin->save();
        $member->save();
    }
}
