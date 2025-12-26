<?php

namespace Modules\Communication\Http\Controllers;

use Modules\Communication\Models\Communication;
use Modules\Shared\Http\Controllers\SharedApiController;

class CommunicationApiController extends SharedApiController
{
    protected function model()
    {
        return Communication::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
    protected function allowedCharts(): array
    {
        return [
            'messages_by_status',          // Sent / Failed / Pending
            'messages_by_mode',            // SMS / Email / WhatsApp / Push
            'messages_by_service',         // Service-wise (OTP, Alert, Promo etc.)
            'messages_by_recipient_type',  // User / Admin / Employee
            'messages_by_session',         // Academic / Financial session wise
            'messages_over_time',          // Date-wise message trend
            'batch_vs_single_messages'     // Batch vs Individual messages
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
            'total_messages',    // Total number of messages
        ];
    }

    protected function defaultAggregates(): array
    {
        return [
            'count:status=1',    // Count of messages sent successfully
            'count:status=0',    // Count of messages failed
        ];
    }

    protected function defaultGroups(): array
    {
        return [
        'mode',              // Group by sending mode (SMS, Email, etc.)
        'recipient_type',    // Group by recipient type
        'service_name',      // Group by service name
        ];
    }





}
