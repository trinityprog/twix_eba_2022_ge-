<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Envoy;
use App\Models\TestUser;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function checkEnvoysPrize()
    {
        $envs = Envoy::query()
            ->where('request', 'like', '%catch%')
            ->where('response', 'like', '%"prize":{%')
            ->where('response', 'like', '%"late":false%')
            ->get();

        return view('admin.test_stats.check-envoys-prize', compact('envs'));
    }

    public function confirmChecks()
    {
        dd(User::query()
            ->whereHas('checks', fn($q) => $q->typeConfirm())
            ->whereHas('tests', fn($q) => $q->whereNotNull('prize_id'))
            ->count());
    }
}
