<?php

use App\Support\ImageUrl;

if (!function_exists('photo_asset')) {
    /**
     * Public URL for an image in storage, or default academy logo if missing.
     */
    function photo_asset(?string $path): string
    {
        return ImageUrl::fallback($path);
    }
}
