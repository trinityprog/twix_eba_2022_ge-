<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Carbon;

class TestUserFilter extends ModelFilter
{
    public function setup()
    {
        return $this->whereHas('user', fn ($q) => $q->where('role', 'user'));
    }

    public function date($date)
    {
        if($date[0] == null && $date[1] == null) return;

        $date_range = [
            Carbon::parse($date[0])->startOfDay(),
            Carbon::parse($date[1])->endOfDay(),
        ];

        return $this->whereBetween('created_at', [$date_range[0], $date_range[1]]);
    }

    public function searchByPhone($phone)
    {
        $phone = blink()->clear($phone);

        return $this->whereHas('user', fn ($q) => $q->whereLike('phone', $phone));
    }

    public function user($id)
    {
        return $this->whereHas('user', fn ($q) => $q->where('id', $id));
    }

    public function id($id)
    {
        return $this->where('id', $id);
    }

    public function prize($id)
    {
        return $this->where('prize_id', $id);
    }

    public function accepted($value)
    {
        return $value
            ? $this->whereNotNull('check_id')
            : null;
    }
}
