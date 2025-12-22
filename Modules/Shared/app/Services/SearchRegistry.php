<?php

namespace Modules\Shared\Services;

use Illuminate\Http\Request;
use Modules\Student\Models\Student;
use Modules\Employee\Models\Employee;
use Modules\Patient\Models\Patient;
use Modules\Customer\Models\Customer;
use Modules\Vendor\Models\Vendor;
use Modules\Product\Models\Product;
use Modules\Service\Models\Service;
use Modules\Subscription\Models\Subscription;
use Modules\Lead\Models\Lead;
use Modules\Consultation\Models\Consultation;
use Modules\Meetingmanager\Models\Meetingmanager;
use Modules\Visitactivity\Models\Visitactivity;
use Modules\Visitplanner\Models\Visitplanner;
use Modules\Treatment\Models\Treatment;
use Modules\Registration\Models\Registration;

class SearchRegistry
{
    public static function resolve(string $module): ?callable
    {
        return match ($module) {
            'students'        => fn ($q, $r) => self::students($q, $r),
            'employees'       => fn ($q, $r) => self::employees($q, $r),
            'patients'        => fn ($q, $r) => self::patients($q, $r),
            'customers'       => fn ($q, $r) => self::customers($q, $r),
            'vendors'         => fn ($q, $r) => self::vendors($q, $r),
            'products'        => fn ($q, $r) => self::products($q, $r),
            'services'        => fn ($q, $r) => self::services($q, $r),
            'subscriptions'   => fn ($q, $r) => self::subscriptions($q, $r),
            'leads'           => fn ($q, $r) => self::leads($q, $r),
            'consultations'   => fn ($q, $r) => self::consultations($q, $r),
            'meetings'        => fn ($q, $r) => self::meetings($q, $r),
            'visitactivities' => fn ($q, $r) => self::visitactivities($q, $r),
            'visitplanners'   => fn ($q, $r) => self::visitplanners($q, $r),
            'treatments'      => fn ($q, $r) => self::treatments($q, $r),
            'registrations'   => fn ($q, $r) => self::registrations($q, $r),
            default           => null,
        };
    }

    /* =============================
     | GENERIC SEARCH
     |=============================*/
    protected static function simple(
        string $q,
        string $model,
        string $route,
        array $fields = ['name'],
        ?callable $descriptionResolver = null,
        ?callable $hrefResolver = null
    ) {
        return $model::where(function ($x) use ($q, $fields) {
                foreach ($fields as $i => $f) {
                    $i === 0
                        ? $x->where($f, 'like', "%{$q}%")
                        : $x->orWhere($f, 'like', "%{$q}%");
                }
            })
            ->limit(20)
            ->get()
            ->map(function ($m) use ($route, $descriptionResolver, $hrefResolver) {
                return [
                    'id' => $m->id,
                    'title' => $m->name ?? ($m->title ?? 'Item'),
                    'description' => $descriptionResolver
                        ? $descriptionResolver($m)
                        : null,
                    'href' => $hrefResolver
                        ? $hrefResolver($m)
                        : "/module/{$route}/{$m->id}",
                ];
            })
            ->values();
    }

    /* =============================
     | MODULE-SPECIFIC CONFIG
     |=============================*/

    protected static function students(string $q, Request $r)
    {
        return self::simple(
            $q,
            Student::class,
            'students',
            ['name', 'phone'],
            fn ($s) => collect([
                $s->admission_number ? "Adm# {$s->admission_number}" : null,
                $s->phone,
                $s->email,
            ])->filter()->join(' • ')
        );
    }

    protected static function employees(string $q, Request $r)
    {
        return self::simple(
            $q,
            Employee::class,
            'employees',
            ['name', 'phone'],
            fn ($e) => collect([
                $e->father_name ? "Father: {$e->father_name}" : null,
                $e->phone,
                $e->email,
            ])->filter()->join(' • ')
        );
    }

    protected static function patients(string $q, Request $r)
    {
        return self::simple(
            $q,
            Patient::class,
            'patients',
            ['name', 'phone'],
            fn ($p) => collect([$p->phone, $p->email])->filter()->join(' • ')
        );
    }

    protected static function customers(string $q, Request $r)
    {
        return self::simple(
            $q,
            Customer::class,
            'customers',
            ['name', 'phone', 'email'],
            fn ($c) => collect([$c->phone, $c->email])->filter()->join(' • ')
        );
    }

    protected static function vendors(string $q, Request $r)
    {
        return self::simple(
            $q,
            Vendor::class,
            'vendors',
            ['name', 'phone'],
            fn ($v) => $v->phone
        );
    }

    protected static function products(string $q, Request $r)
    {
        return self::simple(
            $q,
            Product::class,
            'products',
            ['name', 'sku'],
            fn ($p) => $p->sku
        );
    }

    protected static function services(string $q, Request $r)
    {
        return self::simple($q, Service::class, 'services', ['name']);
    }

    protected static function subscriptions(string $q, Request $r)
    {
        return self::simple($q, Subscription::class, 'subscriptions', ['name']);
    }

    protected static function leads(string $q, Request $r)
    {
        return self::simple(
            $q,
            Lead::class,
            'leads',
            ['name'],
            fn ($l) => $l->status
        );
    }

    protected static function consultations(string $q, Request $r)
    {
        return Consultation::where('reference_no', 'like', "%{$q}%")
            ->limit(20)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'title' => "Consultation #{$c->reference_no}",
                'description' => $c->status,
                'href' => "/module/consultations/{$c->id}",
            ])
            ->values();
    }

    protected static function meetings(string $q, Request $r)
    {
        return self::simple(
            $q,
            Meetingmanager::class,
            'meetings',
            ['title']
        );
    }

    protected static function visitactivities(string $q, Request $r)
    {
        return self::simple(
            $q,
            Visitactivity::class,
            'visitactivities',
            ['title']
        );
    }

    protected static function visitplanners(string $q, Request $r)
    {
        return self::simple(
            $q,
            Visitplanner::class,
            'visitplanners',
            ['title']
        );
    }

    protected static function treatments(string $q, Request $r)
    {
        return self::simple(
            $q,
            Treatment::class,
            'treatments',
            ['name']
        );
    }

    protected static function registrations(string $q, Request $r)
    {
        return self::simple(
            $q,
            Registration::class,
            'registrations',
            ['name']
        );
    }
}
