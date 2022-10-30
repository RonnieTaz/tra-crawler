<?php

if (!function_exists('search_from_end')) {
    function search_from_end(string $haystack, string $needle, ?int $offset = null): string
    {
        return trim(substr($haystack, (strpos($haystack, $needle) + strlen($needle)), $offset));
    }
}
