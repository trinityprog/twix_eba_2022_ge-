<?php

namespace App\Http\Livewire;

use App\Models\DeliveryRegion;
use Livewire\Component;

class Delivery extends Component
{
    public $surname;
    public $name;
    public $index;
    public $region = '0';
    public $locality;
    public $street;
    public $building;
    public $apartament;
    public $commentary;

    protected function rules()
    {
        return [
            'surname' => 'required',
            'name' => 'required',
            'index' => 'required',
            'region' => 'required|exists:delivery_regions,id',
            'locality' => 'required',
            'street' => 'required',
            'building' => 'required',
            'apartament' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        if(auth()->user()->delivery()->exists()) return redirect()->route('profile');

        auth()->user()->delivery()
            ->create([
                'surname' => $this->surname,
                'name' => $this->name,
                'index' => $this->index,
                'region_id' => $this->region,
                'locality' => $this->locality,
                'street' => $this->street,
                'building' => $this->building,
                'apartament' => $this->apartament,
                'commentary' => $this->commentary,
            ]);

        return redirect('#delivery-success');
    }

    public function render()
    {
        $regions = DeliveryRegion::all();
        return view('livewire.delivery', compact('regions'));
    }
}
