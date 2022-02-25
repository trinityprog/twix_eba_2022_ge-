<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Carbon;

class UserFilter extends ModelFilter
{
    public function setup()
    {
        return $this->where('role', 'user');
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

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function searchByPhone($phone)
    {
        $phone = blink()->clear($phone);

        return $this->whereLike('phone', $phone);
    }

    public function id($id)
    {
        return $this->where('id', $id);
    }
}
