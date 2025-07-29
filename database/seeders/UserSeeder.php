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
                'first_name' => 'Angelo',
                'last_name' => 'Serenuela',
                'email' => 'angelo.sytian@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TYPE_ADMIN,
                'created_by' => '1'
            ],

            [
                'first_name' => 'Property',
                'last_name' => 'Manager',
                'email' => 'property.manager@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::PROPERTY_MANAGER,
                'created_by' => '1'
            ],
            [
                'first_name' => 'Tenant',
                'last_name' => 'Tenant',
                'email' => 'tenant@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::TENANT,
                'created_by' => '1'
            ],

            [
                'first_name' => 'Owner',
                'last_name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::OWNER,
                'created_by' => '1'
            ],
            [
                'first_name' => 'Accountant',
                'last_name' => 'Accountant',
                'email' => 'accountant@gmail.com',
                'password' => Hash::make('admin123'),
                'type' => User::ACCOUNTANT,
                'created_by' => '1'
            ],
        ]);
    }
}
