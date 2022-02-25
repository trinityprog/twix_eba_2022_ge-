<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAnswers extends Model
{
    use HasFactory;

    protected $table = 'test_answers';

    protected $guarded = [];

    public function getImagePathAttribute()
    {
        return $this->image ? asset('i/test/answers/' . $this->image) : '';
    }

//    public function question()
//    {
//        return $this->belongsTo(TestQuestion::class);
//    }
//
//    public function variants()
//    {
//        return $this->belongsToMany(TestVariant::class);
//    }
    public function results()
    {
        return $this->belongsToMany(TestAnswers::class, 'test_answer_result', 'result_id', 'answer_id');
    }
}
