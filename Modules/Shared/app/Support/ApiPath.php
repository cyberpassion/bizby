<?php

namespace Modules\Shared\Support;

class ApiPath
{
    public static function make(string $resource): string
    {
        return str_replace('.', '/', $resource);
    }
}
