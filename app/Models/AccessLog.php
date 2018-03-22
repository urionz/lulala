<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $dateFormat = 'U';
    protected $table = 'access_log';
    protected $fillable = [
        'ip', 'user_id', 'template', 'refresh', 'languages', 'browser', 'platform', 'device', 'angent', 'hash'
    ];
}
