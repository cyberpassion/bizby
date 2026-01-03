<?php

namespace Modules\Shared\Services;

use Illuminate\Support\Facades\DB;
use Modules\Shared\Helpers\PleskHelper;

class TenantDatabaseService
{
    /* -------------------------------------------------
     | Create Database
     |-------------------------------------------------*/
    public function create(string $databaseName): void
    {
        match (config('tenant.db_driver')) {
            'sql'   => $this->createViaSql($databaseName),
            'plesk' => $this->createViaPlesk($databaseName),
            default => throw new \Exception('Invalid TENANT_DB_DRIVER'),
        };
    }

    protected function createViaSql(string $databaseName): void
    {
        DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");
    }

    protected function createViaPlesk(string $databaseName): void
    {
        PleskHelper::createBlankDatabase($databaseName);
    }

    /* -------------------------------------------------
     | Delete Database
     |-------------------------------------------------*/
    public function delete(string $databaseName): bool
    {
        return match (config('tenant.db_driver')) {
            'sql'   => $this->deleteViaSql($databaseName),
            'plesk' => $this->deleteViaPlesk($databaseName),
            default => throw new \Exception('Invalid TENANT_DB_DRIVER'),
        };
    }

    protected function deleteViaSql(string $databaseName): bool
    {
        DB::statement("DROP DATABASE IF EXISTS `$databaseName`");
        return true;
    }

    protected function deleteViaPlesk(string $databaseName): bool
    {
        return PleskHelper::deletePleskDatabase($databaseName);
    }
}
