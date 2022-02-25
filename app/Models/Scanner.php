<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scanner extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMethodTextAttribute()
    {
        return $this->method == 'scan' ? 'скан': 'файл';
    }

    public function getTypeTextAttribute()
    {
        return $this->type == 'regular' ? 'Обычный' : 'Подтверждение приза';
    }

    public function getImagePathAttribute()
    {
        return asset('storage/scanners/' . $this->image);
    }
}
