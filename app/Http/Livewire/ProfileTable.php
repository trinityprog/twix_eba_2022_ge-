<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ProfileTable extends Component
{
    use WithPagination;

    public function render()
    {
        $data = $data = auth()->user()->scanners()->typeRegular()->latest()->paginate(8)->onEachSide(1);
        return view('livewire.profile-table', compact('data'));
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
