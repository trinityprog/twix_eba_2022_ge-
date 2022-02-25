<?php

namespace App\Http\Livewire\Auth;

use App\Models\Envoy;
use App\Models\User;
use App\Services\UserCodeService;
use Duke\Blink\BlinkRule;
use Illuminate\Support\Carbon;
use Livewire\Component;

class SmsForgot extends Component
{
    public $phone;

    protected function rules()
    {
        $this->phone = blink()->clear($this->phone);
        return [
            'phone' => ['required', new BlinkRule(), 'exists:users']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

            return redirect()->route('index', [
                'phone' => $this->phone,
                '#register-submit'
            ]);
        }
    }

    public function render()
    {
        $this->dispatchBrowserEvent('componentRender');

        return view('livewire.auth.sms-forgot');
    }
}
