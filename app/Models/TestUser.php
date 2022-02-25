<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestUser extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public function check()
    {
        return $this->belongsTo(Check::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }

    public function result()
    {
        return $this->belongsTo(TestResult::class, 'result_id');
    }

    public function envoy()
    {
        return $this->belongsTo(Envoy::class);
    }
}
