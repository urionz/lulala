<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class QueryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QueryListener  $event
     * @return void
     */
    public function handle($event)
    {
//        if (env('APP_ENV', 'production') == 'local') {
//            $sql = str_replace("?", "'%s'", $event->sql);
//            $log = vsprintf($sql, $event->bindings);
//            Log::info($log);
//        }
    }
}
