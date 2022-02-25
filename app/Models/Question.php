<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getStatusTextAdminAttribute()
    {
        switch ($this->status) {
            case 0: return 'Ждет ответа';
            case 1: return 'Отвечен';
            default: return '-';
        }
    }

    public function getStatusLabelAdminClassesAttribute() {
        switch ($this->status) {
            case 0: return 'text-orange-700 bg-orange-100';
            case 1: return 'text-green-700 bg-green-100';
            default: return '-';
        }
    }
}
