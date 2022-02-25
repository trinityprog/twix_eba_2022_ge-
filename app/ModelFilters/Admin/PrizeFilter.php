<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

class PrizeFilter extends ModelFilter
{
    public function id($id)
    {
        return $this->where('id', $id);
    }
}
