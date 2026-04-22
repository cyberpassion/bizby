<?php

namespace Modules\Shared\Services;

use Illuminate\Support\Str;

class ReportRegistry
{
    /**
     * Central module → model mapping
     */
    public static function moduleMap(): array
    {
        return [
            /* ================= CORE ================= */
            'signup'       => \Modules\Signup\Models\Signup::class,
            'subscription' => \Modules\Subscription\Models\Subscription::class,
			'tenant'       => \Modules\Admin\Models\Tenants\TenantAccount::class,

            /* ================= PEOPLE ================= */
            'student'  => \Modules\Student\Models\Student::class,
            'employee' => \Modules\Employee\Models\Employee::class,
            'customer' => \Modules\Customer\Models\Customer::class,
            'patient'  => \Modules\Patient\Models\Patient::class,
            'vendor'   => \Modules\Vendor\Models\Vendor::class,
            'lead'     => \Modules\Lead\Models\Lead::class,

            /* ================= ACTIVITY ================= */
            'attendance'     => \Modules\Attendance\Models\Attendance::class,
            'survey'         => \Modules\Survey\Models\Survey::class,
            'checklist'      => \Modules\Checklist\Models\Checklist::class,
            //'note'           => \Modules\Note\Models\Note::class,
            //'event'          => \Modules\Events\Models\Event::class,
            //'meeting'        => \Modules\Meetings\Models\Meeting::class,
            //'visit'          => \Modules\Visits\Models\Visit::class,
            //'task'           => \Modules\TaskPlanner\Models\Task::class,

            /* ================= COMMUNICATION ================= */
            'communication' => \Modules\Communication\Models\Communication::class,

            /* ================= BUSINESS / OPERATIONS ================= */
            'booking'     => \Modules\Booking\Models\Booking::class,
            'cashflow'    => \Modules\Cashflow\Models\Cashflow::class,
            'listing'     => \Modules\Listing\Models\Listing::class,
            'product'     => \Modules\Product\Models\Product::class,
            'saleservice' => \Modules\SaleService\Models\SaleService::class,
            'service'     => \Modules\Service\Models\Service::class,
            'transport'   => \Modules\Transport\Models\Transport::class,

            /* ================= EDUCATION ================= */
            'registration' => \Modules\Registration\Models\Registration::class,
            //'examresult'   => \Modules\ExamResult\Models\ExamResult::class,
            'timetable'    => \Modules\Timetable\Models\Timetable::class,
            'attendance' => \Modules\Attendance\Models\Attendance::class,
            'library'    => \Modules\Library\Models\Library::class,

            /* ================= HEALTHCARE ================= */
            'treatment'    => \Modules\Treatment\Models\Treatment::class,
            'consultation' => \Modules\Consultation\Models\Consultation::class,
            'patient'   	=> \Modules\Patient\Models\Patient::class,
        ];
    }

    /**
     * Resolve model class safely
     */
    public static function resolveModel(string $module): string
    {
        $map = static::moduleMap();

        abort_unless(isset($map[$module]), 404, 'Invalid module');

        return $map[$module];
    }

    /**
     * Domain validation logic (centralized)
     */
    public static function validateDomain(?string $allowedDomain): void
    {
        if (!$allowedDomain) {
            return;
        }

        $origin  = request()->headers->get('origin');
        $referer = request()->headers->get('referer');

        abort_unless(
            ($referer && Str::contains($referer, $allowedDomain)) ||
            ($origin && Str::contains($origin, $allowedDomain)),
            403,
            'Unauthorized embed domain'
        );
    }
}