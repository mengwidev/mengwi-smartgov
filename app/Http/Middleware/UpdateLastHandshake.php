<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastHandshake
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->user()?->currentAccessToken();

        /** @var \Laravel\Sanctum\PersonalAccessToken|null $token */

        if ($token) {
            $token->forceFill([
                'last_used_at' => now(),
            ])->save();
        }

        return $next($request);
    }
}
