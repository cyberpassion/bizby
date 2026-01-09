<?php

namespace Modules\Shared\Services\OnlinePayments;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class PayableResolver
{
    protected array $payables = [
        'tenant'	=>	\Modules\Admin\Models\Tenants\TenantAccount::class
    ];

    public function resolve(string $type, int $id): Model
    {
        if (! array_key_exists($type, $this->payables)) {
            throw new InvalidArgumentException('Invalid payable type');
        }

        $modelClass = $this->payables[$type];

        $model = $modelClass::find($id);

        if (! $model) {
            throw new InvalidArgumentException('Payable record not found');
        }

        return $model;
    }
}