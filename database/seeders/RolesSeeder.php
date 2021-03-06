<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = new Role();
        $member->type = 'member';

        $admin = new Role();
        $admin->type = 'admin';

        $member->save();
        $admin->save();
    }
}
