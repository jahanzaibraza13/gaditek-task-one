<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    const SERVICES_DATA = [
        [
            'name' => 'Mobile',
            'description' => 'This is a phone for usage.',
            'price' => 200
        ],
        [
            'name' => 'Computer',
            'description' => 'This is a computer for usage.',
            'price' => 400
        ],
        [
            'name' => 'Laptop',
            'description' => 'This is a laptop for usage.',
            'price' => 600
        ],
        [
            'name' => 'Tablet',
            'description' => 'This is a tablet for usage.',
            'price' => 100
        ]
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::SERVICES_DATA as $service) {
            DB::table('services')->insert([
                'name' => $service['name'],
                'description' => $service['description'],
                'price' => $service['price'],
            ]);
        }
    }
}
