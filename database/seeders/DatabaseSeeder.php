<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Prize;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::forceCreate([
            'name' => 'АДМИНИСТРАТОР',
            'email' => 'admin@twixpromo.az',
            'phone' => '+X XXX XXX XX XX',
            'role' => 'admin',
            'password' => bcrypt('NSh<#;SzFUd95J*s'),
        ]);

        $this->call([
            TestSeeder::class,
            PrizeSeeder::class,
            DeliveryRegionSeeder::class,
            FaqSeeder::class
//            LocalSeeder::class //TODO only local
        ]);
    }
}
