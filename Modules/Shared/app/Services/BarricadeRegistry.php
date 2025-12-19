<?php
namespace Modules\Shared\Services;

class BarricadeRegistry
{
    protected static array $rules = [];

    public static function register(string $route, array $rules): void
    {
        static::$rules[$route] = $rules;
    }

    public static function get(string $route): array
    {
        return static::$rules[$route] ?? [];
    }

    public static function all(): array
    {
        return static::$rules;
    }
}
