<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public function getImagePathAttribute()
    {
        return asset('i/prizes/' . $this->codename . '.png');
    }

    public function getDonatedCountAttribute()
    {
        return $this->type == 'instant'
            ? TestUser::where('prize_id', $this->id)->count()
            : Winner::where('prize_id', $this->id)->count();
    }

    public function getDonatedAcceptedCountAttribute()
    {
        return $this->type == 'instant'
            ? TestUser::where('prize_id', $this->id)->whereNotNull('check_id')->count()
            : Winner::where('prize_id', $this->id)->count();
    }

    public function getBalanceCountAttribute()
    {
        return $this->initial_amount - $this->donatedAcceptedCount;
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ru' ? $this->general : $this->locale;
    }
}
