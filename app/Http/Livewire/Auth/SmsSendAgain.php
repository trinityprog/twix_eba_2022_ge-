<?php

namespace App\Http\Livewire\Auth;

use App\Models\Envoy;
use App\Models\User;
use App\Services\UserCodeService;
use Duke\Blink\BlinkRule;
use Illuminate\Support\Carbon;
use Livewire\Component;

class SmsSendAgain extends Component
{
    public $phone;
    public $sended = 0;
    public $countdown = 60;

    protected function rules()
    {
        $this->phone = blink()->clear($this->phone);
        return [
            'phone' => ['required', new BlinkRule(), 'exists:users']
        ];
    }

    public function submit(UserCodeService $userCodeService)
    {
        $this->validate();

        $user = User::where([
            'phone' => $this->phone
        ])->first();

        $startTime = now();
        $finishTime = Carbon::parse($user->sms_updated_at);
        $diffInSeconds = $finishTime->diffInSeconds($startTime);

        if($user && $diffInSeconds > 60)
        {
            $user->update([
                'sms' => rand(1111, 9999),
                'sms_updated_at' => now(),
            ]);

            $userCodeService->send($user->phone, $user->sms);
            $this->dispatchBrowserEvent('send-sms', [
                'phone' => $this->phone,
                'type' => 'login',
            ]);

            Envoy::whereNull('user_id')
                ->where('request', 'like', '%' . $this->phone . '%')
                ->where('type', 'user_code')
                ->update(['user_id' => $user->id]);

            $this->sended = 1;
        }
    }

    public function decrement()
    {
        $this->countdown--;
        if($this->countdown == 0) {
            $this->sended = 0;
            $this->countdown = 60;
        }
    }

    public function render()
    {
        $this->dispatchBrowserEvent('componentRender');

        return view('livewire.auth.sms-send-again');
    }
}
