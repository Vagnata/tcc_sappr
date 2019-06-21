<?php

if (!function_exists('removeNullItems')) {
    function removeNullItems(array $attributes): array
    {
        return $attributes = array_filter($attributes, function ($value) {
            return !is_null($value);
        });
    }
}
