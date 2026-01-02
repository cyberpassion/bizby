<?php

namespace Modules\Shared\Helpers;

use Modules\Shared\Services\PleskService;

class PleskHelper
{
    public static function createBlankDatabase(string $name)
    {
        return app(PleskService::class)->createDatabase($name);
    }

    public static function deletePleskDatabase(string $databaseName): bool
    {
        $plesk = app(PleskService::class);

        $databases = $plesk->getDatabases();

        if (! isset($databases[$databaseName])) {
            return false;
        }

        return $plesk->deleteDatabase($databases[$databaseName]);
    }
}
