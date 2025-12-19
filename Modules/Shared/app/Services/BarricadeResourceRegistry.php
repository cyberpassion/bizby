<?php
namespace Modules\Shared\Services;

class BarricadeResourceRegistry
{
    protected static array $resolvers = [];

    /**
     * Register a resolver for a resource key
     */
    public static function register(string $resource, callable $resolver): void
    {
        static::$resolvers[$resource] = $resolver;
    }

    /**
     * Resolve a resource existence check
     */
    public static function exists(string $resource, array $filter = []): bool
    {
        if (!isset(static::$resolvers[$resource])) {
            // Unknown resource → assume OK or fail (your choice)
            return true;
        }

        return (static::$resolvers[$resource])($filter);
    }
}
