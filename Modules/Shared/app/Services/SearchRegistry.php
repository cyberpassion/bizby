<?php
namespace Modules\Shared\Services;

use Illuminate\Http\Request;
use Modules\Student\Models\Student;
use Modules\Employee\Models\Employee;

class SearchRegistry
{
    public static function resolve(string $module)
    {
        return match ($module) {
            'students' => new StudentSearch(),
            default    => null,
        };
    }
}

class StudentSearch
{
    public function search(string $q, Request $request)
    {
        return Student::query()
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('phone', 'like', "%{$q}%")
                      ->orWhere('admission_number', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get()
            ->map(function (Student $student) {
                return [
					'id' => $student->id,
                    'title' => $student->name ?? 'Unnamed Student',
                    'description' => collect([
                        $student->admission_number
                            ? 'Adm# ' . $student->admission_number
                            : null,
                        $student->phone,
                        $student->email,
                    ])->filter()->join(' • '),

                    'href' => "/module/students/{$student->id}",
                ];
            })
            ->values(); // reset keys
    }
}

class EmployeeSearch
{
    public function search(string $q, Request $request)
    {
        return Employee::query()
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('phone', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get()
            ->map(function (Employee $employee) {
                return [
					'id' => $employee->id,
                    'title' => $employee->name ?? 'Unnamed Employee',
                    'description' => collect([
                        $employee->father_name
                            ? 'Father: ' . $employee->father_name
                            : null,
                        $employee->phone,
                        $employee->email,
                    ])->filter()->join(' • '),

                    'href' => "/module/employees/{$employee->id}",
                ];
            })
            ->values(); // reset keys
    }
}
