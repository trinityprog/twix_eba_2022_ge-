<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

class TestResultFilter extends ModelFilter
{
    public function id($id)
    {
        return $this->where('id', $id);
    }
}
