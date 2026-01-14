<?php

namespace Modules\Admin\DatabaseManagers;

use Stancl\Tenancy\TenantDatabaseManagers\MySQLDatabaseManager;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Helpers\PleskHelper;

class PleskMySQLDatabaseManager extends MySQLDatabaseManager
{
    public function createDatabase(TenantWithDatabase $tenant): bool
    {
        $databaseName = $tenant->tenancy_db_name;

        return match (config('tenant.db_driver')) {
            'sql'   => $this->createViaSql($databaseName),
            'plesk' => $this->createViaPlesk($databaseName),
            default => throw new \RuntimeException('Invalid TENANT_DB_DRIVER'),
        };
    }

    public function deleteDatabase(TenantWithDatabase $tenant): bool
    {
        $databaseName = $tenant->tenancy_db_name;

        return match (config('tenant.db_driver')) {
            'sql'   => $this->deleteViaSql($databaseName),
            'plesk' => $this->deleteViaPlesk($databaseName),
            default => throw new \RuntimeException('Invalid TENANT_DB_DRIVER'),
        };
    }

    /* -----------------------------
     | Internal helpers
     |------------------------------*/

    protected function createViaSql(string $databaseName): bool
    {
        DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");
        return true;
    }

    protected function createViaPlesk(string $databaseName): bool
	{
    	// 1. If DB already exists, we're done
	    if ($this->databaseExists($databaseName)) {
    	    return true;
    	}

	    $attempts = 6;
    	$lastError = null;

	    while ($attempts-- > 0) {
    	    try {
        	    $response = PleskHelper::createBlankDatabase($databaseName);

	            // Plesk is unreliable: empty / null may still mean success
    	        if (
        	        $response === null ||
            	    $response === [] ||
                	($response['status'] ?? true) === true
	            ) {
    	            // Wait until MySQL actually sees it
        	        $this->waitForDatabase($databaseName);
            	    return true;
            	}

	            $lastError = $response;
    	    } catch (\Throwable $e) {
        	    $lastError = $e->getMessage();
        	}

	        // Backoff
    	    usleep(700_000); // 700ms
    	}

	    // FINAL safety net:
	    // If DB exists now, treat as success
    	if ($this->isDatabaseExists($databaseName)) {
        	return true;
    	}

	    throw new \RuntimeException(
    	    "Plesk DB creation failed for {$databaseName}. Last error: " .
        	json_encode($lastError)
	    );
	}

	protected function isDatabaseExists(string $databaseName): bool
	{
    	return !empty(DB::select(
        	"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?",
        	[$databaseName]
	    ));
	}

	protected function waitForDatabase(string $databaseName, int $retries = 12): void
	{
    	while ($retries-- > 0) {
	        if ($this->databaseExists($databaseName)) {
    	        return;
        	}
	        usleep(300_000); // 300ms
    	}

	    throw new \RuntimeException(
    	    "Database {$databaseName} not visible after creation"
    	);
	}

    protected function deleteViaSql(string $databaseName): bool
    {
        DB::statement("DROP DATABASE IF EXISTS `$databaseName`");
        return true;
    }

    protected function deleteViaPlesk(string $databaseName): bool
    {
        $response = PleskHelper::deletePleskDatabase($databaseName);

        if ($response === false) {
            throw new \RuntimeException(
                "Plesk DB deletion failed for {$databaseName}"
            );
        }

        return true;
    }
}
