<?php

namespace Modules\Shared\Services;

use Illuminate\Support\Facades\Http;

class PleskService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('plesk.base_url'), '/');
    }

    protected function client()
    {
        return Http::withBasicAuth(
                config('plesk.username'),
                config('plesk.password')
            )
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->withoutVerifying(); // same as -k
    }

    /* ---------------------------------
     | Create Database
     |----------------------------------*/
    public function createDatabase(
        string $name,
        string $type = 'mysql'
    ): array {
        $payload = [
            'name' => $name,
            'type' => $type,
            'parent_domain' => [
                'id'   => config('plesk.host_id'),
                'name' => config('plesk.host_name'),
            ],
            'server_id' => config('plesk.server_id'),
        ];

        $response = $this->client()
            ->post("{$this->baseUrl}/api/v2/databases", $payload);

        if ($response->successful()) {
            return [
                'status'   => true,
                'response' => $response->json(),
            ];
        }

        if ($response->json('code') === 1007) {
            return [
                'status'   => false,
                'response' => 'Database already exists',
            ];
        }

        return [
            'status'   => false,
            'response' => $response->json() ?? 'Unknown error',
        ];
    }

    /* ---------------------------------
     | Delete Database
     |----------------------------------*/
    public function deleteDatabase(int $databaseId): bool
    {
        $response = $this->client()
            ->delete("{$this->baseUrl}/api/v2/databases/{$databaseId}");

        return $response->successful();
    }

    /* ---------------------------------
     | Get All Databases
     |----------------------------------*/
    public function getDatabases(): array
    {
        $response = $this->client()
            ->get("{$this->baseUrl}/api/v2/databases");

        if (! $response->successful()) {
            return [];
        }

        $databases = [];

        foreach ($response->json() as $db) {
            $databases[$db['name']] = $db['id'];
        }

        return $databases;
    }
}
