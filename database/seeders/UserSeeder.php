<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks to allow truncating tables that are referenced by other tables.
        // This is necessary during seeding to avoid foreign key constraint violations,
        // especially when truncating parent tables like `users` that are referenced by others tables.
        // WARNING: Do not use this in production without understanding the impact on data integrity.

        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('users')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // CREATE ROLE FOR USERS
        $roles = [
            ['name' => USER::TYPE_ADMIN, 'guard_name' => 'web'],
            ['name' => USER::TYPE_REGULAR_ADMIN, 'guard_name' => 'web'],
            ['name' => USER::TENANT_MANAGER, 'guard_name' => 'web'],
            ['name' => USER::OWNER, 'guard_name' => 'web'],
            ['name' => USER::PROPERTY_MANAGER, 'guard_name' => 'web'],
            ['name' => USER::TENANT, 'guard_name' => 'web'],
            ['name' => USER::ACCOUNTANT, 'guard_name' => 'web']
        ];
        Role::insert($roles);



        // CREATE DUMMY USERS
        $users = [
            [
                'first_name' => 'Ryan Vergel',
                'last_name' => 'Hojilla',
                'email' => 'yanz.sytian@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TYPE_ADMIN,
                'created_by' => 1,
            ],
            [
                'first_name' => 'Barlaw Kenneth',
                'last_name' => 'Sytian',
                'email' => 'kenneth@sytian-productions.com',
                'password' => Hash::make('admin123'),
                'type' => User::TYPE_ADMIN,
                'created_by' => 1,
            ],
            [
                'first_name' => 'Regular',
                'last_name' => 'Admin',
                'email' => 'regular.admin@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TYPE_REGULAR_ADMIN,
                'created_by' => 1,
            ],
            [
                'first_name' => 'Tenant',
                'last_name' => 'fIRST',
                'email' => 'tenant@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TENANT,
                'created_by' => 1,
            ],
            [
                'first_name' => 'Tenant',
                'last_name' => 'First',
                'email' => 'tenantmanager1@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TENANT_MANAGER,
                'created_by' => 1,
            ],
            [
                'first_name' => 'Tenant',
                'last_name' => 'Second',
                'email' => 'tenantmanager2@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TENANT_MANAGER,
                'created_by' => 1,
            ],
            [
                'first_name' => 'Owner',
                'last_name' => 'ownder',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::OWNER,
                'created_by' => 1,
            ],
            [
                'first_name' => 'Property',
                'last_name' => 'Manager',
                'email' => 'propertymanager@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::PROPERTY_MANAGER,
                'created_by' => 1,
            ],
            [
                'first_name' => 'accountant',
                'last_name' => 'accountant',
                'email' => 'accountant@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::ACCOUNTANT,
                'created_by' => 1,
            ],
        ];

        User::insert($users);
    }
}
