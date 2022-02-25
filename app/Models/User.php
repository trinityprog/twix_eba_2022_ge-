<?php

namespace App\Models;

use App\Services\AlgApiService;
use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Filterable, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'phone', 'sms', 'sms_updated_at', 'email', 'status', 'source', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendVerificationCode()
    {
        $url = 'https://smsc.ru/sys/send.php?login=twixeba22&psw=global777&phones='.$this->phone.'&mes='.$this->sms.'&call=1';

        file_get_contents($url);
    }

    public function tests()
    {
        return $this->hasMany(TestUser::class);
    }

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function scanners()
    {
        return $this->hasMany(Scanner::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public function envoys()
    {
        return $this->hasMany(Envoy::class);
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'Зарегистрирован' : 'Проверка номера';
    }

    public function isWinner()
    {
        return $this->tests()->whereNotNull('prize_id')->whereNotNull('check_id')->exists();
    }

    public function hasNotActivatedPrize()
    {
        return $this->tests()->whereNotNull('prize_id')->whereNull('check_id')->exists();
    }

    public function getTestPrize()
    {
        return $this->tests()->whereNotNull('prize_id')->first();
    }

    public function napWithNoCheck()
    {
        return !$this->checks()->where(['type' => 'confirm'])->exists();
    }

    public function napWithModeratingCheck()
    {
        return $this->checks()->where(['type' => 'confirm', 'status' => 0])->exists();
    }

    public function napWithAcceptedCheck()
    {
        return $this->checks()->where(['type' => 'confirm', 'status' => 1])->exists();
    }

    public function napWithDeclinedCheck()
    {
        return $this->checks()->where(['type' => 'confirm', 'status' => 2])->exists();
    }

    public function activatePrize($check_id = 0)
    {
        if(!$this->isWinner())
        {
            $notActivatedPrize = $this->tests()->whereNotNull('prize_id')->whereNull('check_id')->first();

            if($notActivatedPrize != null)
            {
                $notActivatedPrize->update(['check_id' => $check_id]);

                (new AlgApiService())->prizeConfirm([
                    'game_id' => $notActivatedPrize->api_game_id,
                    'prize_id' => $notActivatedPrize->prize->codename,
                    'ip_address' => (new AlgApiService())->getIpAddress()
                ]);

                return true;
            }
        }

        return false;
    }
}
