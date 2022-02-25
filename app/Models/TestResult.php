<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory, Filterable;

    protected $table = 'test_results';

    protected $guarded = [];

    public function getImagePathAttribute()
    {
        return $this->image ? asset('i/test/results/' . $this->image) : '';
    }

    public function getTextAttribute()
    {
        return app()->getLocale() == 'ru' ? $this->general : $this->locale;
    }

    public function answers()
    {
        return $this->belongsToMany(TestAnswers::class, 'test_answer_result', 'result_id', 'answer_id');
    }

    public function getShowAnswersTextAttribute()
    {
        return $this->answers->count() == 3
            ? $this->answers[0]->text . ' - ' . $this->answers[1]->text . ' - '  . $this->answers[2]->text
            : '-';
    }
}
