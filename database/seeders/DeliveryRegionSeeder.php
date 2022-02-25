<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DeliveryRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents(database_path('/files/delivery_regions.sql')));
    }
}
