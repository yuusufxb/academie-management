<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserLevel
{
    public function handle(Request $request, Closure $next, string ...$levels): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'غير مصرح لك بالوصول.');
        }

        $allowedLevels = array_map('intval', $levels);

        if (!in_array((int) $user->niv, $allowedLevels, true)) {
            abort(403, 'ليس لديك الصلاحية للدخول إلى هذا القسم.');
        }

        return $next($request);
    }
}

