<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMediaPermission
{
    public function handle(Request $request, Closure $next, string $ability = 'view'): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'غير مصرح لك بالوصول.');
        }

        $allowed = match ($ability) {
            'view' => $user->canViewMedia(),
            'upload', 'edit', 'delete', 'manage' => $user->canManageMedia(),
            default => false,
        };

        if (!$allowed) {
            abort(403, 'ليس لديك الصلاحية لإدارة الوسائط.');
        }

        return $next($request);
    }
}

