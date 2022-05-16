<?php

require dirname(__DIR__) . '/vendor/autoload.php';

function dd(): never
{
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    die;
}

function test_cache_path(string $path = ''): string
{
    return empty($path) ? __DIR__ . '/cache/' : __DIR__ . '/cache/' . ltrim($path, '/');
}

function remove_cache_file(string $path): bool
{
    if (file_exists(test_cache_path($path))) {
        return unlink(test_cache_path($path));
    }
    return true;
}
