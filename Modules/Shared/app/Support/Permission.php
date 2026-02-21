<?php

namespace Modules\Shared\Support;

use Modules\Shared\Support\BaseActions;

class Permission
{
    public static function make(string $resource, string $action): string
    {
        return "{$resource}.{$action}";
    }

    /* ------------------------------
     | Generic Actions
     |------------------------------*/

    public static function view(string $resource): string
    {
        return self::make($resource, BaseActions::VIEW);
    }

    public static function list(string $resource): string
    {
        return self::make($resource, BaseActions::LIST);
    }

    public static function create(string $resource): string
    {
        return self::make($resource, BaseActions::CREATE);
    }

    public static function update(string $resource): string
    {
        return self::make($resource, BaseActions::UPDATE);
    }

    public static function delete(string $resource): string
    {
        return self::make($resource, BaseActions::DELETE);
    }

    public static function bulk(string $resource): string
    {
        return self::make($resource, BaseActions::BULK);
    }

    public static function report(string $resource): string
    {
        return self::make($resource, BaseActions::REPORT);
    }

    /* ------------------------------
     | Module-Level Helpers
     |------------------------------*/

    public static function access(string $module): string
    {
        return "{$module}.access";
    }
}
