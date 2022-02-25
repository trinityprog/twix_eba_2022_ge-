<?php

namespace App\Http\Livewire;

use App\Models\Prize;
use App\Models\TestQuestion;
use App\Models\TestResult;
use App\Models\TestVariant;
use App\Services\AlgApiService;
use Cookie;
use Livewire\Component;

class TestUser extends Component
{
    public $step = 0;
    public $variant_id;
    public $question;
    public $selectedAnswers = [];
    public $end = false;

    public function firstStep()
    {
        $this->step = 1;
        $this->variant_id = TestVariant::inRandomOrder()->first('id')->id;
        $this->question = TestQuestion::with('answers')
            ->where('variant_id', $this->variant_id)
            ->orderBy('order')
            ->first();

        $this->dispatchBrowserEvent('stop-animation');
        $this->dispatchBrowserEvent('start-test', ['phone' => auth()->user()->phone]);
    }

    public function selectAnswer($id, AlgApiService $algApiService)
    {
        $this->selectedAnswers []= $id;

        if($this->end) return;
        if($this->step == 3) {
            $this->end = true;
            return $this->completeTest($algApiService);
        }
        $this->step++;
        $this->question = TestQuestion::with('answers')
            ->where('variant_id', $this->variant_id)
            ->orderBy('order')
            ->skip($this->step - 1)
            ->first();
    }

    public function completeTest($algApiService)
    {
        $result_id = TestResult::with('answers')
            ->whereHas('answers', fn($q) => $q->whereIn('answer_id', $this->selectedAnswers), '=', 3)
            ->firstOrFail('id')->id;

        $test = auth()->user()->tests()->create([
            'result_id' => $result_id
        ]);

        $request = $algApiService->gamePrize();
        $response = $request->response;

        $test->update(['envoy_id' => $request->envoy_id]);

        $prize_id = null;
        $game_id = null;



        if(isset($response->prize) && $response->prize != null && !auth()->user()->isWinner() && !auth()->user()->hasNotActivatedPrize()) {
            if($response->game_id != null && $response->game_id != "none")
                $game_id = $response->game_id;

            $prize = Prize::where('codename', $response->prize->prize_id)->first();

            if($prize != null)
                $prize_id = $prize->id;

            $request = $algApiService->prizeCatch([
                'game_id' => $game_id,
                'prize_id' => $prize->codename
            ]);
            $response = $request->response;
        }

        if(isset($response->prize_id) && isset($response->late) && $response->late == false) {
            $test->update([
                'prize_id' => $prize_id,
                'api_game_id' => $game_id
            ]);

            $this->dispatchBrowserEvent('prize', [
                'phone' => auth()->user()->phone,
                'prize_id' => $prize->codename
            ]);
        }

        $this->dispatchBrowserEvent('finish-test', ['phone' => auth()->user()->phone]);
        return redirect()->route('test_result', [$test->id, 'event' => 'test_complete']);
    }

    public function render()
    {
        return view('livewire.test-user');
    }
}
