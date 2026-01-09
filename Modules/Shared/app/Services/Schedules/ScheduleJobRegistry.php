<?php

namespace Modules\Shared\Services\Schedules;

class ScheduleJobRegistry
{
    protected static array $jobs = [];

    public static function register(string $key, callable $handler): void
    {
        self::$jobs[$key] = $handler;
    }

    public static function has(string $key): bool
    {
        return array_key_exists($key, self::$jobs);
    }

    public static function run(string $key): void
    {
        if (! self::has($key)) {
            throw new \RuntimeException("Unregistered schedule job: {$key}");
        }

        call_user_func(self::$jobs[$key]);
    }

    public static function all(): array
    {
        return array_keys(self::$jobs);
    }
}
