<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porn extends Model
{
    protected $dateFormat = 'U';
    protected $fillable = ['id', 'code', 'user_id', 'use_id', 'use_at', 'expire_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getUserIdAttribute($value)
    {
        return $value ? User::find($value) : null;
    }

    public function getUseIdAttribute($value)
    {
        return $value ? User::find($value) : null;
    }

    public function getExpireAtAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    public function getUseAtAttribute($value)
    {
        return $value ? date('Y-m-d H:i:s', $value) : null;
    }
}
