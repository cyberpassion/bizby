<?php

namespace Modules\Shared\Services\OnlinePayments;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class PayableResolver
{
    /**
     * List of allowed payable models
     */
    protected array $payables = [
		\Modules\Registration\Models\Registration::class
        // add more payables here
    ];

    /**
     * Resolve payable model safely
     */
    public function resolve(string $type, int $id): Model
    {
        if (! in_array($type, $this->payables, true)) {
            throw new InvalidArgumentException('Invalid payable type');
        }

        $model = $type::find($id);

        if (! $model) {
            throw new InvalidArgumentException('Payable record not found');
        }

        return $model;
    }
}
