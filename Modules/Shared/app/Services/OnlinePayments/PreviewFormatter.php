<?php

namespace Modules\Shared\Services\OnlinePayments;

class PreviewFormatter
{
    public static function make(array $data): array
    {
        return [
            'charge_type' => $data['charge_type'],

            'reference' => [
                'type' => $data['reference_type'] ?? null,
                'id'   => $data['reference_id'] ?? null,
            ],

            'items' => $data['items'],

            'period' => [
                'start' => $data['period_start'] ?? null,
                'end'   => $data['period_end'] ?? null,
            ],

            'breakdown' => [
                'subtotal' => $data['subtotal'],
                'discount' => $data['discount'] ?? 0,
                'tax'      => $data['tax'] ?? 0,
                'total'    => $data['total'],
            ],

            'currency' => $data['currency'] ?? 'INR',

            'flags' => [
                'can_pay' => $data['can_pay'] ?? true,
            ],

            'reason' => $data['reason'] ?? null,
        ];
    }
}
