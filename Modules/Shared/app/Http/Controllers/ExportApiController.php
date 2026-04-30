<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use Modules\Shared\Services\ReportRegistry;
use Modules\Shared\Services\LookupRegistry;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Str;

class ExportApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Column Resolver (centralized lookup)
    |--------------------------------------------------------------------------
    */

    protected function resolveColumns(string $module): array
    {
        $columns = LookupRegistry::get("{$module}.columns.report");

        abort_unless(!empty($columns), 404, "No export columns defined");

        return $columns;
    }

	/*
    |--------------------------------------------------------------------------
    | ✅ ADD HERE — Morph-based Model Resolver
    |--------------------------------------------------------------------------
    */
    protected function resolveModelFromMorph(string $module): string
    {
        $map = \Illuminate\Database\Eloquent\Relations\Relation::morphMap();

        if (!isset($map[$module])) {
            abort(404, "Model not found for module [{$module}]");
        }

        return $map[$module];
    }

    /*
    |--------------------------------------------------------------------------
    | ✅ ADD HERE — Controller Resolver
    |--------------------------------------------------------------------------
    */
    protected function resolveControllerFromModel(string $modelClass)
{
    // Get model name (e.g., Consultation)
    $modelName = class_basename($modelClass);

    // Extract module name (e.g., Consultation)
    $module = Str::of($modelClass)
        ->after('Modules\\')
        ->before('\\')
        ->toString();

    $controllerClass = "Modules\\{$module}\\Http\\Controllers\\{$modelName}ApiController";

    if (!class_exists($controllerClass)) {
        abort(404, "Controller not found: {$controllerClass}");
    }

    return app($controllerClass);
}

    /*
    |--------------------------------------------------------------------------
    | CSV EXPORT
    |--------------------------------------------------------------------------
    */

    public function exportCsv(string $module)
{
    $modelClass = $this->resolveModelFromMorph($module);
    $controller = $this->resolveControllerFromModel($modelClass);

    $columns = $this->resolveColumns($module);

    $dbColumns = array_keys($columns);
    $headings  = array_values($columns);

    $query = $modelClass::query();

    if (!empty($controller->with)) {
        $query->with($controller->with);
    }

    $reportData = $query->get();

    // ✅ APPLY SAME TRANSFORMATION AS API
    $reportData = $controller->transformCollection($reportData, $module);

    // ✅ FILTER COLUMNS AFTER transformation
    $reportData = $reportData->map(function ($row) use ($dbColumns) {
    	return collect($row->toArray())->only($dbColumns)->toArray();
	});

    return Excel::download(
        new class($reportData, $headings) implements FromCollection, WithHeadings {

            protected $data;
            protected $headings;

            public function __construct($data, $headings)
            {
                $this->data = $data;
                $this->headings = $headings;
            }

            public function collection()
            {
                return $this->data;
            }

            public function headings(): array
            {
                return $this->headings;
            }
        },
        "{$module}.csv"
    );
}

    /*
    |--------------------------------------------------------------------------
    | PDF EXPORT
    |--------------------------------------------------------------------------
    */

    public function exportPdf(string $module)
	{
    	$modelClass = $this->resolveModelFromMorph($module);
	    $columns    = $this->resolveColumns($module);

	    $dbColumns = array_keys($columns);
    	$headings  = array_values($columns);

	    // 👇 Resolve controller (important)
    	$controller = $this->resolveControllerFromModel($modelClass);

	    // 👇 Build query
    	$query = $modelClass::query();

	    // 👇 Load relations (same as index)
    	if (!empty($controller->with)) {
        	$query->with($controller->with);
    	}

	    // 👇 Fetch data
    	$reportData = $query->get();

	    // ✅ 👉 ADD IT RIGHT HERE
    	$reportData = $controller->transformCollection($reportData, $module);

	    // (optional) restrict only required columns AFTER transformation
    	$reportData = $reportData->map(function ($row) use ($dbColumns) {
    		return collect($row->toArray())->only($dbColumns)->toArray();
		});

	    // 👇 Pass headings (labels)
    	$html = view('shared::pdf.report', [
        	'reportTitle' => ucfirst($module) . ' Report',
        	'reportData'  => $reportData,
	        'columns'     => $columns,
    	])->render();

	    $mpdf = new \Mpdf\Mpdf([
    	    'mode'   => 'utf-8',
        	'format' => 'A4',
	    ]);

	    $mpdf->WriteHTML($html);

	    return response($mpdf->Output('', 'S'))
    	    ->header('Content-Type', 'application/pdf')
        	->header('Content-Disposition', "attachment; filename=\"{$module}.pdf\"");
	}

}