<?php

namespace Modules\Shared\Services;

class LookupRegistry
{
    protected static array $items = [];

    /**
     * Register a lookup key with static array or callback.
     * If same key already exists → merge intelligently.
     */
    public static function register(string $key, $value): void
    {
        // Key not registered yet, save directly
        if (!array_key_exists($key, self::$items)) {
            self::$items[$key] = $value;
            return;
        }

        // Merge with existing
        $existing = self::$items[$key];
        self::$items[$key] = self::mergeValues($existing, $value);
    }

    /**
     * Merge two lookup definitions (arrays/callbacks).
     */
    protected static function mergeValues($a, $b)
    {
        // Case 1: array + array
        if (is_array($a) && is_array($b)) {
            return array_merge($a, $b);
        }

        // Case 2: closure + closure
        if (is_callable($a) && is_callable($b)) {
            return function () use ($a, $b) {
                return array_merge(
                    $a() ?? [],
                    $b() ?? []
                );
            };
        }

        // Case 3: array + closure
        if (is_array($a) && is_callable($b)) {
            return function () use ($a, $b) {
                return array_merge(
                    $a,
                    $b() ?? []
                );
            };
        }

        // Case 4: closure + array
        if (is_callable($a) && is_array($b)) {
            return function () use ($a, $b) {
                return array_merge(
                    $a() ?? [],
                    $b
                );
            };
        }

        // Fallback (should not be needed)
        return $b;
    }

    /**
     * Check if lookup exists
     */
    public static function has(string $key): bool
    {
        return array_key_exists($key, self::$items);
    }

    /**
     * Get lookup: if callback, execute
     */
    public static function get(string $key)
    {
        if (!self::has($key)) {
            return null;
        }

        $value = self::$items[$key];

        return is_callable($value)
            ? ($value() ?? [])
            : $value;
    }

    /**
     * Get all lookup keys
     */
    public static function all(): array
    {
        return array_keys(self::$items);
    }
}
