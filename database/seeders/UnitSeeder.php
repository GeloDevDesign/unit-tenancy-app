<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // CREATE PROPERTY
        Property::insert(
            [
                'name' => 'Sytian Residence',
                'location' => 'Quezon City',
                'building' => 'A'
            ],
            [
                'name' => 'Sytian Residence',
                'location' => 'Quezon City',
                'building' => 'B'
            ],
            [
                'name' => 'Sytian Residence',
                'location' => 'Quezon City',
                'building' => 'C'
            ],
            [
                'name' => 'Sytian Residence',
                'location' => 'Quezon City',
                'building' => 'D'
            ]
        );

        Unit::insert(
            [
                'occupant_id' => 4,
                'tenant_manager' => 5,
                'unit_number' => '1-00001-A',
                'floor' => 'A',
                'capacity_count' => 'A',
                'sqm_size' => 'A',
                'property_id' => 1
            ],

            [
                'occupant_id' => 4,
                'tenant_manager' => 5,
                'unit_number' => 'Quezon City',
                'floor' => 'A',
                'capacity_count' => 'A',
                'sqm_size' => 'A',
                'property_id' => 1
            ],

            [
                'occupant_id' => 4,
                'tenant_manager' => 5,
                'unit_number' => 'Quezon City',
                'floor' => 'A',
                'capacity_count' => 'A',
                'sqm_size' => 'A',
                'property_id' => 1
            ],

            [
                'occupant_id' => 4,
                'tenant_manager' => 5,
                'unit_number' => 'Quezon City',
                'floor' => 'A',
                'capacity_count' => 'A',
                'sqm_size' => 'A',
                'property_id' => 1
            ],

            [
                'occupant_id' => 4,
                'tenant_manager' => 5,
                'unit_number' => 'Quezon City',
                'floor' => 'A',
                'capacity_count' => 'A',
                'sqm_size' => 'A',
                'property_id' => 1
            ],


        );
    }
}
