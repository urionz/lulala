<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Middleware\ThrottleRequests;

class ThrottleMiddleware extends ThrottleRequests
{
    protected function buildResponse($key, $maxAttempts)
    {
        $response = new Response(json_encode(['error' => '尝试太频繁,请稍后再试..']), 429);

        $retryAfter = $this->limiter->availableIn($key);

        return $this->addHeaders(
            $response, $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts, $retryAfter),
            $retryAfter
        );
    }
}
