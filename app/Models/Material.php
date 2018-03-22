<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $dateFormat = 'U';
    protected $fillable = ['id', 'user_id', 'material', 'original'];

    public static function scopeOfOwn($query, $userId)
    {
        $query->where('user_id', $userId);
    }

    public function getOriginalAttribute($value)
    {
        return $this->user_id == 10000 ? '' : $value;
    }
}
