<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRegion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTextAttribute()
    {
        return app()->getLocale() == 'ru' ? $this->general : $this->locale;
    }
}
