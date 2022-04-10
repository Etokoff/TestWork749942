<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ResponseAPI;

class ApiKeyMiddleware
{
    use ResponseAPI;

    public function handle($request, Closure $next)
    {
        if(!$key = $request->get('apikey') or $key !== config('app.api_key')) {
            return $this->error('Wrong API key', 403);
        }

        return $next($request);
    }
}
