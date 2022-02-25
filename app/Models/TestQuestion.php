<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTextAttribute()
    {
        return app()->getLocale() == 'ru' ? $this->general : $this->locale;
    }

    public function variant()
    {
        return $this->belongsTo(TestVariant::class, 'variant_id');
    }

    public function answers()
    {
        return $this->hasMany(TestAnswers::class, 'question_id');
    }
}
