<?php

namespace Modules\Shared\Services;

class LookupRegistry
{
    protected static array $items = [];

    /**
     * Fallback resolver (used when key is not explicitly registered)
     */
    protected static $fallbackResolver = null;

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
        self::$items[$key] = self::mergeValues(self::$items[$key], $value);
    }

    /**
     * Register a fallback resolver.
     * This will be called if lookup key is not explicitly registered.
     */
    public static function registerFallback(callable $resolver): void
    {
        self::$fallbackResolver = $resolver;
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

        // Fallback (should not normally happen)
        return $b;
    }

    /**
     * Check if lookup exists (explicitly registered)
     */
    public static function has(string $key): bool
    {
        return array_key_exists($key, self::$items);
    }

    /**
     * Get lookup value
     * Priority:
     * 1️⃣ Explicitly registered lookup
     * 2️⃣ Fallback resolver (eg: shared.* → terms table)
     * 3️⃣ null
     */
    public static function get(string $key)
    {
        // 1️⃣ Explicit lookup
        if (self::has($key)) {
            $value = self::$items[$key];

            return is_callable($value)
                ? ($value() ?? [])
                : $value;
        }

        // 2️⃣ Fallback lookup
        if (self::$fallbackResolver) {
            return call_user_func(self::$fallbackResolver, $key);
        }

        // 3️⃣ Not found
        return null;
    }

    /**
     * Get all explicitly registered lookup keys
     */
    public static function all(): array
    {
        return array_keys(self::$items);
    }
}
