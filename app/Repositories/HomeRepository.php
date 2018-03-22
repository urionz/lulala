<?php
/**
 * Created by PhpStorm.
 * User: urionz
 * Date: 2017/1/6
 * Time: 20:05
 */

namespace App\Repositories;


use App\Models\Template;
use Cache;

class HomeRepository
{
    public function published($user)
    {
        return Template::ofOwn($user)->published()->first();
    }
}