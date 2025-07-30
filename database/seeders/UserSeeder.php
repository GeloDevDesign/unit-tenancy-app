<?php

namespace Database\Seeders;

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
        User::truncate();
        User::insert([
            [
                'first_name' => 'Ryan Vergel',
                'last_name' => 'Hojilla',
                'email' => 'yanz.sytian@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TYPE_ADMIN,
                'created_by' => '1'
            ],
            [
                'first_name' => 'Barlaw Kenneth',
                'last_name' => 'Sytian',
                'email' => 'kenneth@sytian-productions.com',
                'password' => Hash::make('admin123'),
                'type' => User::TYPE_ADMIN,
                'created_by' => '1'
            ],
            [
                'first_name' => 'Regular',
                'last_name' => 'Admin',
                'email' => 'regular.admin@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TYPE_REGULAR_ADMIN,
                'created_by' => '1'
            ],
            [
                'first_name' => 'Tenant',
                'last_name' => 'tenant',
                'email' => 'tenant@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TENANT,
                'created_by' => '1'
            ],
            [
                'first_name' => 'Tenant',
                'last_name' => 'manager',
                'email' => 'tenantmanager@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TENANT_MANAGER,
                'created_by' => '1'
            ],

            [
                'first_name' => 'Owner',
                'last_name' => 'ownder',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::OWNER,
                'created_by' => '1'
            ],

            [
                'first_name' => 'Property',
                'last_name' => 'Manager',
                'email' => 'propertymanager@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::PROPERTY_MANAGER,
                'created_by' => '1'
            ],
            [
                'first_name' => 'accountant',
                'last_name' => 'accountant',
                'email' => 'accountant@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::ACCOUNTANT,
                'created_by' => '1'
            ],

        ]);
    }
}
