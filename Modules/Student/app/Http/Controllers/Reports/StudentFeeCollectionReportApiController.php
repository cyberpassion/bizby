<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeSubmission;
use Modules\Student\Models\StudentFeeSubmissionItem;
use Modules\Student\Models\StudentFeeDiscount;
use Modules\Student\Models\StudentTransition;
use Modules\Student\Models\StudentAcademicHistory;

class StudentFeeCollectionReportApiController extends Controller
{
    public function index(Request $request)
	{

	    $query = StudentFeeSubmission::query()
    	    ->with([
        	    'student:id,name,phone,father_name',
            	'academicYear:id,name',
	            'classTerm:id,name,group',
		        'sectionTerm:id,name,group',
        	]);

	    if ($request->filled('year_id')) {
    	    $query->where('year_id', $request->year_id);
    	}

	    if ($request->filled('from_date')) {
    	    $query->whereDate(
        	    'created_at',
            	'>=',
            	$request->from_date
        	);
    	}

	    if ($request->filled('to_date')) {
    	    $query->whereDate(
        	    'created_at',
            	'<=',
	            $request->to_date
    	    );
    	}

	    $result = $query
    	    ->latest()
        	->paginate(20)
        	->through(function ($item) {

	            return $item->makeHidden([
    	            'student',
        	        'academic_year',
            	    'class_term',
                	'section_term',
	            ]);
    	    });

	    return response()->json([
    	    'status' => 'success',
        	'data' => $result
	    ]);
	}

    public function daily(Request $request)
    {
        $data = StudentFeeSubmission::query()
            ->selectRaw('DATE(created_at) as date')
            ->selectRaw('SUM(amount_received) as total_collection')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function headWise(Request $request)
    {
        $data = StudentFeeSubmissionItem::query()
            ->select('fee_structure_id')
            ->selectRaw('SUM(paid_amount) as total_paid')
            ->groupBy('fee_structure_id')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}