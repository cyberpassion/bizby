<?php
namespace Modules\Admin\Enums\Tenants;

enum InstallationStatus: string {
    case PENDING = 'pending';
    case RUNNING = 'running';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
}
