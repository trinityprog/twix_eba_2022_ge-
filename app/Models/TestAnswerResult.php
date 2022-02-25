<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAnswerResult extends Model
{
    use HasFactory;

    protected $table = 'test_answer_result';

    protected $guarded = [];

    public $timestamps = [];
}
