<?php

if (!function_exists('assets')) {
    /**
     * Generate asset URL.
     *
     * @param string $path
     * @return string
     */
    function asset(string $path): string
    {
        return base_url($path);
    }
}
