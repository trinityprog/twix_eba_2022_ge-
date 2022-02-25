<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date:d.m.Y',
        'time' => 'date:H:i'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeTypeRegular($query)
    {
        return $query->where('type', 'regular');
    }

    public function scopeTypeConfirm($query)
    {
        return $query->where('type', 'confirm');
    }

    public function scopeAcceptedStatus($query)
    {
        return $query->where('status', 1);
    }

    public function scopeCountAcceptedThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->typeRegular()
            ->acceptedStatus()
            ->count();
    }

    public function statusText($lang = null) {
        $lang = $lang ?? app()->getLocale();
        return __('backend.check_statuses', [], $lang)[$this->status];
//        switch ($this->status) {
//            case 0: return (app()->getLocale() == 'ru') ? 'На модерации' : 'Модерацияда';
//            case 1: return (app()->getLocale() == 'ru') ? 'Принят' : 'Қабылданды';
//            case 2: return (app()->getLocale() == 'ru') ? 'Отклонен' : 'Қабылданбады';
//            default: return '-';
//        }
    }

    public function getStatusColorNameAttribute() {
        switch ($this->status) {
            case 0: return 'violet';
            case 1: return 'brown';
            case 2: return 'red';
            default: return '-';
        }
    }

    public function getImagePathAttribute()
    {
        return asset('storage/checks/' . $this->image);
    }

    public function getStatusLabelAdminClassesAttribute() {
        switch ($this->status) {
            case 0: return 'text-orange-700 bg-orange-100';
            case 1: return 'text-green-700 bg-green-100';
            case 2: return 'text-red-700 bg-red-100';
            default: return '-';
        }
    }

    public function getTypeTextAttribute()
    {
        return $this->type == 'regular' ? 'Обычный' : 'Подтверждение приза';
    }

    public function getDuplicates()
    {
        return $this->where('date', $this->date)
            ->where('time', $this->time)
            ->where('sum', $this->sum)
            ->count() - 1;
    }
}
