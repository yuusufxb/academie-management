<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class ImageUrl
{
    /**
     * URL for a file under storage/app/public, or academy logo if missing/empty.
     */
    public static function fallback(?string $path): string
    {
        $fallback = asset('images/akadimiya.jpg');

        if ($path === null || trim((string) $path) === '') {
            return $fallback;
        }

        $path = ltrim($path, '/');

        if (Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return $fallback;
    }
}
