<?php

namespace Modules\Shared\Barricade;

use Illuminate\Support\Facades\Schema;
use Stancl\Tenancy\Facades\Tenancy;
use Modules\Shared\Services\BarricadeResourceRegistry;

// Shared
use Modules\Shared\Models\Term;

// Core modules
use Modules\Announcement\Models\Announcement;
use Modules\Attendance\Models\Attendance;

use Modules\Booking\Models\BookingVenue;
use Modules\Booking\Models\BookableUnit;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\BookingUnitPricing;
use Modules\Cashflow\Models\Cashflow;
use Modules\Checklist\Models\Checklist;
use Modules\Communication\Models\Communication;
use Modules\Consultation\Models\Consultation;
use Modules\Contact\Models\Contact;
use Modules\Customer\Models\Customer;
use Modules\Employee\Models\Employee;
use Modules\Eventmanager\Models\Eventmanager;
use Modules\Examresult\Models\Examresult;
use Modules\Lead\Models\Lead;
use Modules\Leaveapplication\Models\Leaveapplication;
use Modules\Library\Models\Library;
use Modules\Listing\Models\Listing;
use Modules\Meetingmanager\Models\Meetingmanager;
use Modules\Note\Models\Note;
use Modules\Patient\Models\Patient;
use Modules\Product\Models\Product;
use Modules\Registration\Models\Registration;
use Modules\Saleservice\Models\Saleservice;
use Modules\Service\Models\Service;
use Modules\Signup\Models\Signup;
use Modules\Student\Models\Student;
use Modules\Subscription\Models\Subscription;
use Modules\Survey\Models\Survey;
use Modules\Test\Models\Test;
use Modules\Timetable\Models\Timetable;
use Modules\Transport\Models\Transport;
use Modules\Treatment\Models\Treatment;
use Modules\Vendor\Models\Vendor;
use Modules\Visitactivity\Models\Visitactivity;
use Modules\Visitplanner\Models\Visitplanner;

class SharedBarricadeResources
{
    public static function register(): void
    {
        // 🔹 TERMS (shared taxonomy)
        self::registerResource('terms', Term::class);

        // 🔹 CORE / BUSINESS ENTITIES
        self::registerResource('announcements', Announcement::class);
        self::registerResource('attendances', Attendance::class);
        
		self::registerResource('bookings', Booking::class);
		self::registerResource('bookings-venue', BookingVenue::class);
		self::registerResource('bookings-unit', BookableUnit::class);
		self::registerResource('bookings-pricing', BookingUnitPricing::class);

        self::registerResource('cashflows', Cashflow::class);
        self::registerResource('checklists', Checklist::class);
        self::registerResource('communications', Communication::class);
        self::registerResource('consultations', Consultation::class);
        self::registerResource('contacts', Contact::class);
        self::registerResource('customers', Customer::class);
        self::registerResource('employees', Employee::class);
        self::registerResource('eventmanagers', Eventmanager::class);
        self::registerResource('examresults', Examresult::class);
        self::registerResource('leads', Lead::class);
        self::registerResource('leaveapplications', Leaveapplication::class);
        self::registerResource('libraries', Library::class);
        self::registerResource('listings', Listing::class);
        self::registerResource('meetingmanagers', Meetingmanager::class);
        self::registerResource('notes', Note::class);
        self::registerResource('patients', Patient::class);
        self::registerResource('products', Product::class);
        self::registerResource('registrations', Registration::class);
        self::registerResource('saleservices', Saleservice::class);
        self::registerResource('services', Service::class);
        self::registerResource('signups', Signup::class);
        self::registerResource('students', Student::class);
        self::registerResource('subscriptions', Subscription::class);
        self::registerResource('surveys', Survey::class);
        self::registerResource('tests', Test::class);
        self::registerResource('timetables', Timetable::class);
        self::registerResource('transports', Transport::class);
        self::registerResource('treatments', Treatment::class);
        self::registerResource('vendors', Vendor::class);
        self::registerResource('visitactivities', Visitactivity::class);
        self::registerResource('visitplanners', Visitplanner::class);
    }

    /**
     * Generic barricade resource registration
     */
    protected static function registerResource(string $resource, string $modelClass): void
    {
        BarricadeResourceRegistry::register(
	        $resource,
    	    function (array $filter) use ($modelClass): bool {
				return true;

	            if (! tenant()) {
    	            return false; // or true, depending on your policy
        	    }

	            return tenancy()->run(function () use ($modelClass, $filter) {

	                $model = new $modelClass();

    	            if (!Schema::hasTable($model->getTable())) {
        	            return false;
            	    }

	                $query = $modelClass::query();

    	            foreach ($filter as $column => $value) {
        	            $query->where($column, $value);
            	    }

	                return $query->exists(); // ✅ guaranteed tenant DB
    	        });
        	}
    	);
    }

}
