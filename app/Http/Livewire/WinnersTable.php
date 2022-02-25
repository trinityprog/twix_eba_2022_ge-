<?php

namespace App\Http\Livewire;

use App\Models\TestUser;
use App\Models\Winner;
use Livewire\Component;
use Livewire\WithPagination;

class WinnersTable extends Component
{
    use WithPagination;

    public $phone;

    public $selected_table = 'instant'; // weekly

    protected $listeners = ['winnerSearch', 'changeTable'];

    public function winnerSearch($phone)
    {
        $this->resetPage();
        $this->phone = blink()->clear($phone);
    }

    public function changeTable($table)
    {
        $this->resetPage();
        $this->selected_table = $table;
    }

    public function render()
    {
        if($this->selected_table == 'instant')
            $query = TestUser::with(['user', 'prize'])
                ->where(
                    fn($q) => $q->whereNotNull('prize_id')
                        ->whereBetween('created_at', [now()->subDays(3), now()])
                        ->orWhereNotNull('scanner_id')
                )->when($this->phone != null, function ($q) {
                    return $q->whereHas('user', fn ($q) => $q->where('phone', $this->phone));
                })
                ->latest();
        else
            $query = Winner::with(['user', 'prize'])->when($this->phone != null, function ($q) {
                return $q->whereHas('user', fn ($q) => $q->where('phone', $this->phone));
            })
                ->latest('won_at');



        $data = $query->paginate(8)->onEachSide(0)
            ->through(fn($row) => collect([
                'date' => $this->selected_table == 'instant'
                    ? $row->created_at->format('d.m.Y')
                    : $row->won_at->format('d.m.Y'),
                'phone' => blink()->hide($row->user->phone),
                'prize_name' => app()->getLocale() == 'ru'
                    ? $row->prize->general
                    : $row->prize->locale
            ]));

        return view('livewire.winners-table', compact('data'));
    }

    public function paginationView()
    {
        return 'livewire.pagination';
    }
}
