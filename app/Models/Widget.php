<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $dateFormat = 'U';
    protected $fillable = ['id', 'user_id', 'data', 'sort'];
}
