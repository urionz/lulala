<?php

namespace App\Modules\Home\Http\Middleware;

use App\Models\AccessLog;
use App\Models\Template;
use Closure;
use Agent;
use Hash;

class AccessLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->user;
        $template = Template::where('user_id', $userId)->where('status', 1)->first();
        if($template){
            $clienIp = $request->getClientIp();
            $browser = Agent::browser();
            $platform = Agent::platform();
            $device = Agent::device();
            $validateStr = md5($clienIp . $userId . $template->id . $browser . $platform . $device);
            $hash = Hash::make($validateStr);
            $data = [
                'ip' => $request->getClientIp(),
                'user_id' => $userId,
                'template' => $template->id,
                'languages' => Agent::languages()[0],
                'browser' => Agent::browser(),
                'platform' => Agent::platform(),
                'device' => Agent::device(),
                'angent' => Agent::getUserAgent(),
                'hash' => $hash
            ];
            if($old = AccessLog::where('ip', $data['ip'])
                                ->where('user_id', $data['user_id'])
                                ->where('template', $data['template'])
                                ->where('browser', $data['browser'])
                                ->where('platform', $data['platform'])
                                ->where('device', $data['device'])
                                ->lockForUpdate()
                                ->first()) {
                if(Hash::check($validateStr, $old->hash)){
                    $old->increment('refresh');
                }else{
                    AccessLog::create($data);
                }
            }else{
                AccessLog::create($data);
            }
        }
        return $next($request);
    }
}
