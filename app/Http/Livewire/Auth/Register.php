<?php

namespace App\Http\Livewire\Auth;

use App\Models\Envoy;
use App\Models\User;
use App\Services\AlgApiService;
use App\Services\UserCodeService;
use Carbon\Carbon;
use Duke\Blink\BlinkRule;
use Illuminate\Support\Str;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $phone;
    public $email;
    public $gender;

    protected function rules()
    {
        $this->phone = blink()->clear($this->phone);
        return [
            'name' => 'required|min:2|max:100',
            'phone' => ['required', 'unique:users', new BlinkRule()],
            'email' => 'required|email|unique:users',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit(UserCodeService $userCodeService, AlgApiService $algApiService)
    {
        $this->validate();

        // action end
        if(Carbon::parse(config('limits.END_PROMO'))->isPast()){ return redirect('/'); }

        $new_user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'sms' => rand(1111, 9999),
            'sms_updated_at' => now(),
            'password' => Str::random(12)
        ]);

        $userCodeService->send($new_user->phone, $new_user->sms);
        $this->dispatchBrowserEvent('send-sms', [
            'phone' => $this->phone,
            'type' => 'register',
        ]);

        $algApiService->userRegister([
            'id' => $new_user->phone,
            'city' => 'NONE',
            'email' => $new_user->email,
            'first_name' => $new_user->name,
            'last_name' => 'NONE',
        ]);

        Envoy::whereNull('user_id')
            ->where('request', 'like', '%' . $this->phone . '%')
            ->update(['user_id' => $new_user->id]);

        return redirect()->route('index', [
            'phone' => $new_user->phone,
            '#register-submit'
        ]);
    }

    public function render()
    {
        $this->dispatchBrowserEvent('componentRender');

        return view('livewire.auth.register');
    }
}
