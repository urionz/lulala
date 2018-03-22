<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    public function cities()
    {
        return $this->hasMany(Cities::class, 'provinceid', 'cityid');
    }

    public function getCitiesAttribute()
    {
        return Cities::where('provinceid', $this->provinceid)->get();
    }
}