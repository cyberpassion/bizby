<?php

namespace Modules\Shared\Services\Schedules;

class ScheduleJobRegistry
{
    protected static array $jobs = [];

    public static function register(
        string $key,
        callable $handler,
        array $meta = []
    ): void {
        self::$jobs[$key] = array_merge([
            'key' => $key,
            'handler' => $handler,
            'class' => $meta['class'] ?? null,
            'description' => $meta['description'] ?? null,
            'defaults' => $meta['defaults'] ?? [],
            'allowed_frequencies' => $meta['allowed_frequencies'] ?? [],
            'module' => $meta['module'] ?? null,
        ], $meta);
    }

    public static function has(string $key): bool
    {
        return isset(self::$jobs[$key]);
    }

    public static function run(string $key): void
    {
        if (! self::has($key)) {
            throw new \RuntimeException("Unregistered schedule job: {$key}");
        }

        call_user_func(self::$jobs[$key]['handler']);
    }

    /**
     * Return FULL job details
     */
    public static function all(): array
    {
        return self::$jobs;
    }

    /**
     * Only keys (if needed)
     */
    public static function keys(): array
    {
        return array_keys(self::$jobs);
    }

    /**
     * Single job details
     */
    public static function get(string $key): array
    {
        if (! self::has($key)) {
            throw new \RuntimeException("Unregistered schedule job: {$key}");
        }

        return self::$jobs[$key];
    }
}
