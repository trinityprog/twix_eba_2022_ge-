<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchByPhone extends Component
{
    public $phone;

    public function render()
    {
        return view('livewire.search-by-phone');
    }

    public function submit()
    {
        $this->emit('winnerSearch', $this->phone);
    }
}
