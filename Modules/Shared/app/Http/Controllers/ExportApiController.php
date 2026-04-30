<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use Modules\Shared\Services\ReportRegistry;
use Modules\Shared\Services\LookupRegistry;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
    | CSV EXPORT
    |--------------------------------------------------------------------------
    */

    public function exportCsv(string $module)
    {
		$modelClass = ReportRegistry::resolveModel($module);
        $columns = $this->resolveColumns($module);

		$dbColumns = array_keys($columns);   // DB fields
		$headings  = array_values($columns); // Labels

        return Excel::download(
		    new class($modelClass, $dbColumns, $headings) implements FromQuery, WithHeadings {

		        protected string $modelClass;
        		protected array  $dbColumns;
		        protected array  $headings;

		        public function __construct(string $modelClass, array $dbColumns, array $headings)
        		{
		            $this->modelClass = $modelClass;
        		    $this->dbColumns  = $dbColumns;
            		$this->headings   = $headings;
        		}

		        public function query()
        		{
		            return $this->modelClass::query()
        		        ->select($this->dbColumns); // ✅ correct
        		}

		        public function headings(): array
        		{
		            return $this->headings; // ✅ correct
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
		$modelClass = ReportRegistry::resolveModel($module);
        $columns = $this->resolveColumns($module);

		$dbColumns = array_keys($columns);
		$headings  = array_values($columns);

		$reportData = $modelClass::query()
		    ->select($dbColumns) // ✅ correct
    		->get();

        $html = view('shared::pdf.report', [
            'reportTitle'  => ucfirst($module) . ' Report',
            'tenantName'   => '',
            'tenantByline' => '',
            'reportData'   => $reportData,
            'columns'      => $headings,
        ])->render();

        $mpdf = new Mpdf([
            'mode'   => 'utf-8',
            'format' => 'A4',
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "attachment; filename=\"{$module}.pdf\"");
    }
}