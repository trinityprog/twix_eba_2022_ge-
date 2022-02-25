<?php

namespace Database\Seeders;

use App\Models\Prize;
use Illuminate\Database\Seeder;

class PrizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prize::create([
            'general' => '2000 манат',
            'locale' => '2000 манат',
            'initial_amount' => 7
        ]);
        Prize::create([
            'general' => 'Мобильный баланс (номинал 5 манат)',
            'locale' => 'Мобильный баланс (номинал 5 манат)',
            'codename' => 'balance',
            'delivery_by' => 'text_balance',
            'type' => 'instant',
            'initial_amount' => 500
        ]);
        Prize::create([
            'general' => 'Шоубокс TWIX',
            'locale' => 'Шоубокс TWIX',
            'codename' => 'showbox',
            'delivery_by' => 'delivery',
            'type' => 'instant',
            'initial_amount' => 100
        ]);
        Prize::create([
            'general' => 'Промо-коды Hungry.az (номинал 4 маната)',
            'locale' => 'Промо-коды Hungry.az (номинал 4 маната)',
            'codename' => 'hungry',
            'delivery_by' => 'giftcode',
            'type' => 'instant',
            'initial_amount' => 100
        ]);
    }
}
