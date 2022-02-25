<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Carbon;

class CheckFilter extends ModelFilter
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

    public function status($status)
    {
        return $this->where('status', $status);
    }

    public function source($source)
    {
        return $this->where('source', $source);
    }

    public function type($type)
    {
        return $this->where('type', $type);
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

    public function duplicate($duplicate)
    {
        if($duplicate[0] == null && $duplicate[1] == null && $duplicate[2] == null) return;

        return $this->where('date', Carbon::parse($duplicate[0]))
            ->where('time', Carbon::parse($duplicate[1]))
            ->where('sum', $duplicate[2]);
    }
}
