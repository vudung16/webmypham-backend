<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_role = Role::where('slug','developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $dev_create_perm = Permission::where('slug','create-tasks')->first();
        $dev_delete_perm = Permission::where('slug','delete-tasks')->first();
        $manager_perm = Permission::where('slug','view-users')->first();

        $developer_create = new User();
        $developer_create->name = 'I am developer - Create';
        $developer_create->email = 'test@gmail.com';
        $developer_create->password = bcrypt('12345678');
        $developer_create->image = '1.jpg';
        $developer_create->phone = '012345678';
        $developer_create->role = 2;
        $developer_create->role_admin = 255;
        $developer_create->save();
        $developer_create->roles()->attach($dev_role);
        $developer_create->permissions()->attach($dev_create_perm);

        $developer_delete = new User();
        $developer_delete->name = 'I am developer - Delete';
        $developer_delete->email = 'dev_delete@test.com';
        $developer_delete->password = bcrypt('12345678');
        $developer_delete->image = '1.jpg';
        $developer_delete->phone = '012345678';
        $developer_delete->role = 1;
        $developer_delete->save();
        $developer_delete->roles()->attach($dev_role);
        $developer_delete->permissions()->attach($dev_delete_perm);

        $developer_full = new User();
        $developer_full->name = 'I am developer - Full';
        $developer_full->email = 'dev_full@test.com';
        $developer_full->password = bcrypt('12345678');
        $developer_full->image = '1.jpg';
        $developer_full->phone = '012345678';
        $developer_full->role = 1;
        $developer_full->save();
        $developer_full->roles()->attach($dev_role);
        $developer_full->permissions()->attach($dev_create_perm);
        $developer_full->permissions()->attach($dev_delete_perm);

        $manager = new User();
        $manager->name = 'I am manager';
        $manager->email = 'manager@test.com';
        $manager->password = bcrypt('12345678');
        $manager->image = '1.jpg';
        $manager->phone = '012345678';
        $manager->role = 1;
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);

        $manager1 = new User();
        $manager1->name = 'I am manager1';
        $manager1->email = 'manager1@test.com';
        $manager1->password = bcrypt('12345678');
        $manager1->image = '1.jpg';
        $manager1->phone = '012345678';
        $manager1->role = 1;
        $manager1->save();
        $manager1->roles()->attach($manager_role);
    }
}
