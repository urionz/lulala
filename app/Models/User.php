<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'province', 'city', 'area', 'nickname', 'used', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function materials()
    {
        return $this->hasMany('App\Models\Material', 'user_id', 'id');
    }

    public function widgets()
    {
        return $this->hasMany('App\Models\Widget', 'user_id', 'id');
    }

    public function templates()
    {
        return $this->hasMany('App\Models\Template', 'user_id', 'id');
    }

    public function porns()
    {
        return $this->hasMany('App\Models\Porn', 'user_id', 'id');
    }

    public function getProvinceAttribute($value)
    {
        $province = Provinces::where('provinceid', $value)->first();
        return $value && $province ? $province->province : '';
    }

    public function getCityAttribute($value)
    {
        $city = Cities::where('cityid', $value)->first();
        return $value && $city ? $city->city : '';
    }

    public function getAreaAttribute($value)
    {
        $area = Areas::where('areaid', $value)->first();
        return $value && $area ? $area->area : '';
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}
