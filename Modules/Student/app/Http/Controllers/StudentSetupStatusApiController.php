<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentAcademicYear;
use Modules\Student\Models\StudentFeeStructurePattern;

use Modules\Shared\Models\Term;

class StudentSetupStatusApiController extends Controller
{
    public function index()
    {
        return response()->json([
            "status" => "success",

            "data" => [

                "academic_years" => [
                    "exists" => StudentAcademicYear::query()->exists(),
                    "count"  => StudentAcademicYear::query()->count(),
                ],

                "classes" => [
                    "exists" => Term::query()->where("group", "classes")->exists(),
                    "count"  => Term::query()->where("group", "classes")->count(),
                ],

                "sections" => [
                    "exists" => Term::query()->where("group", "sections")->exists(),
                    "count"  => Term::query()->where("group", "sections")->count(),
                ],

                "fee_heads" => [
                    "exists" => Term::query()->where("group", "fee-heads")->exists(),
                    "count"  => Term::query()->where("group", "fee-heads")->count(),
                ],

                "fee_patterns" => [
                    "exists" => StudentFeeStructurePattern::query()->exists(),
                    "count"  => StudentFeeStructurePattern::query()->count(),
                ],

            ],
        ]);
    }
}