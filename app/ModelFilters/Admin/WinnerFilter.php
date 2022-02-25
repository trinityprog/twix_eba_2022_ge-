<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Carbon;

class WinnerFilter extends ModelFilter
{
    public function date($date)
    {
        if($date[0] == null && $date[1] == null) return;

        $date_range = [
            Carbon::parse($date[0])->startOfDay(),
            Carbon::parse($date[1])->endOfDay(),
        ];

        return $this->whereBetween('won_at', [$date_range[0], $date_range[1]]);
    }

    public function searchByPhone($phone)
    {
        $phone = blink()->clear($phone);

        return $this->whereLike('phone', $phone);
    }
}
