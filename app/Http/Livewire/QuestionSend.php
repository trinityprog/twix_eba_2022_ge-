<?php

namespace App\Http\Livewire;

use App\Mail\QuestionCreated;
use App\Models\Question;
use Duke\Blink\BlinkRule;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class QuestionSend extends Component
{
    public $name;
    public $phone;
    public $email;
    public $question;

    protected function rules()
    {
        $this->phone = blink()->clear($this->phone);
        return [
            'name' => 'required|min:2|max:100',
            'phone' => ['required', new BlinkRule()],
            'email' => 'required|email',
            'question' => 'required|min:8|max:1000',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $question  = Question::create($this->validate());
        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new QuestionCreated($question));
        } catch (\Exception $e) {
            info('error mail form faq - '. $e->getMessage());
        }

         $this->name = null;
         $this->phone = null;
         $this->email = null;
         $this->question = null;

        return redirect('/#faq-success');
    }

    public function render()
    {
        return view('livewire.question-send');
    }
}
