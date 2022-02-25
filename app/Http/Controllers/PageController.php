<?php

namespace App\Http\Controllers;

use App\Http\Livewire\TestUser;
use App\Models\Faq;
use App\Models\Prize;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Str;
use URL;

class PageController extends Controller
{
    public function index()
    {
        if(Carbon::parse(config('limits.START_PROMO'))->isPast() || Str::contains(URL::current(), 'test'))
        {
            $faqs = Faq::oldest('order')->get();
            $prizes_images = Prize::where('type', 'instant')->orderBy('order')->get(['codename'])->pluck('imagePath');
            return view('pages.index', compact('faqs', 'prizes_images'));
        }
        return 1;
    }

    public function home()
    {
        if(auth()->check() && auth()->user()->role == 'admin') return redirect()->route('admin.index');
        return redirect()->route('index');
    }

    public function test_result($id)
    {
        $test = auth()->user()->tests()
            ->with(['prize', 'result'])
            ->findOrFail($id);

        $canAction = true;
        if(config('limits.ACTION') == 'checks')
            $count = auth()->user()->checks()
                ->typeRegular()
                ->whereDate('created_at', today())
                ->count();
        else
            $count = auth()->user()->scanners()
                ->whereDate('created_at', today())
                ->count();
        if($count == config('limits.ACTIONS_PER_DAY'))
            $canAction = false;

        return view('pages.test.result', compact('test', 'canAction'));
    }
    public function profile()
    {
        $scanners_count = auth()->user()->scanners()->countThisWeek();
        $test_prize = auth()->user()->getTestPrize();
        $hasNotActivatedPrize = auth()->user()->hasNotActivatedPrize();
        $isWinner = auth()->user()->isWinner();

        return view('pages.profile', compact('scanners_count', 'test_prize', 'hasNotActivatedPrize', 'isWinner'));
    }

    public function delivery()
    {
        if(!auth()->user()->isWinner() && auth()->user()->napWithNoCheck() && auth()->user()->delivery()->exists())
            return redirect()->route('profile');

        $test_prize = auth()->user()->getTestPrize();

        return view('pages.delivery', compact('test_prize'));
    }
}
