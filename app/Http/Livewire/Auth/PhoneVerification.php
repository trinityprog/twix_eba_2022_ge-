<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Duke\Blink\BlinkRule;
use Livewire\Component;

class PhoneVerification extends Component
{
    public $phone;
    public $sms;

    protected function rules()
    {
        $this->phone = blink()->clear($this->phone);
        return [
            'phone' => ['required', new BlinkRule()],
            'sms' => 'required|digits:4'
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        $user = User::where([
            'phone' => $this->phone,
            'sms' => $this->sms
        ])->first();

        if(! $user) return $this->addError('failed', __('validation.custom.auth_failed'));

        $ga_trigger = $user->status ? null : ['event' => 'register_user'];
        $user->update(['status' => '1']);
        auth()->login($user);

        $this->dispatchBrowserEvent('login', ['phone' => auth()->user()->phone]);
        return redirect()->route('test', $ga_trigger);
    }

    public function render()
    {
        $this->dispatchBrowserEvent('componentRender');

        return view('livewire.auth.phone-verification');
    }
}
