<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Widget;

class Template extends Model
{
    protected $dateFormat = 'U';
    protected $fillable = ['id', 'user_id', 'widgets', 'background', 'border', 'title', 'thumbnail', 'status', 'sort'];

    public function getWidgetsAttribute($value){
        return json_decode($value);//将组件json数据转数组
    }

    public function getBorderAttribute($value){
        return json_decode($value);
    }

    public function scopePublished($query){
        $query->where('status', 1);
    }

    public function scopeOfPublished($query, $status){
        $query->where('status', $status);
    }

    public static function scopeOfOwn($query, $userId){
        $query->where('user_id', $userId);
    }

    public static function scopeOfId($query, $id)
    {
        $query->where('id', $id);
    }
}
