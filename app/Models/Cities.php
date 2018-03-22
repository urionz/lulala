<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    public function province()
    {
        return $this->belongsTo(Provinces::class, 'provinceid', 'provinceid');
    }
}
