<?php

namespace Database\Seeders;

use App\Models\Check;
use App\Models\Faq;
use App\Models\Prize;
use App\Models\Question;
use App\Models\TestUser;
use App\Models\User;
use App\Models\Winner;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::factory(20)->create();
        User::factory(100)->create();
        Check::factory(50)->create();
        Question::factory(20)->create();
        Winner::factory(7)->create();

        TestUser::factory(200)->create();
        Check::factory(50)
            ->create([
                'status' => 1,
                'type' => 'confirm'
            ])
            ->each(function ($check) {
                $prize_id = Prize::inRandomOrder()
                    ->where('type', 'instant')
                    ->first('id')
                    ->id;

                TestUser::inRandomOrder()
                    ->whereNull('prize_id')
                    ->first()
                    ->update([
                       'check_id' => $check->id,
                       'prize_id' => $prize_id
                    ]);
            });
    }
}
