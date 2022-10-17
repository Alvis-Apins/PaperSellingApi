<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Sale;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        DB::table('warehouses')->insert([
            [
                'item' => 'A6 - Letter paper',
                'type' => 'paper',
                'price' => 10.22,
                'description' => 'A6 paper for writing letters',
                'amount' => 10,
                'created_at' => now()
            ],
            [
                'item' => 'A4 - 500 regular pieces of paper',
                'type' => 'paper',
                'price' => 16.22,
                'description' => 'A4 paper for printer',
                'amount' => 20,
                'created_at' => now()
            ],
            [
                'item' => 'A3 - 300 regular pieces of paper',
                'type' => 'paper',
                'price' => 22.22,
                'description' => 'A3 paper for printer',
                'amount' => 15,
                'created_at' => now()
            ],
            [
                'item' => 'A2 - 100 regular pieces of paper',
                'type' => 'paper',
                'price' => 42.22,
                'description' => 'A2 paper for plotter',
                'amount' => 10,
                'created_at' => now()
            ],
            [
                'item' => 'A1 - 20 regular pieces of paper',
                'type' => 'paper',
                'price' => 72.22,
                'description' => 'A1 paper for plotter',
                'amount' => 5,
                'created_at' => now()
            ],
            [
                'item' => 'Sticky notes',
                'type' => 'paper',
                'price' => 2.22,
                'description' => 'Sticky notes for daily reminders',
                'amount' => 15,
                'created_at' => now()
            ],
            [
                'item' => '20 blue pens',
                'type' => 'office-supply',
                'price' => 12.25,
                'description' => 'Blue pen 0.7 line thickness',
                'amount' => 10,
                'created_at' => now()
            ],
            [
                'item' => '20 black pens',
                'type' => 'office-supply',
                'price' => 12.25,
                'description' => 'Black pen 0.7 line thickness',
                'amount' => 10,
                'created_at' => now()
            ],
            [
                'item' => 'Stapler',
                'type' => 'office-supply',
                'price' => 4.52,
                'description' => 'Stapler for stapling paper together',
                'amount' => 5,
                'created_at' => now()
            ]
        ]);

        Partner::factory(10)
            ->create()
            ->each(function ($partner) {
                Sale::factory(rand(1,5))
                    ->create(['partner_id' => $partner->id]);
            });


        $warehouse = Warehouse::all();
        Sale::all()->each(function (Sale $sales) use ($warehouse) {
            $sales->warehouse()->attach(
                $warehouse->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
