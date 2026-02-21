<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class ExportApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SIMPLE MODULE CONFIG (temporary – clean & clear)
    |--------------------------------------------------------------------------
    */

    protected function moduleMap()
    {
        return [
            'employee' => \Modules\Employee\Models\Employee::class,

            // Add more modules later
            // 'student' => \Modules\Student\Models\Student::class,
        ];
    }

    protected function resolveModel($module)
    {
        $map = $this->moduleMap();

        if (!isset($map[$module])) {
            abort(404, "Invalid export module");
        }

        return $map[$module];
    }

    protected function resolveColumns($module)
    {
        return \Modules\Shared\Services\LookupRegistry::get("{$module}.columns.report");
    }

    /*
    |--------------------------------------------------------------------------
    | CSV EXPORT
    |--------------------------------------------------------------------------
    */

    public function exportCsv($module)
    {
        $model   = $this->resolveModel($module);
        $columns = $this->resolveColumns($module);

        return Excel::download(
            new class($model, $columns) implements
                \Maatwebsite\Excel\Concerns\FromQuery,
                \Maatwebsite\Excel\Concerns\WithHeadings
            {
                protected $model;
                protected $columns;

                public function __construct($model, $columns)
                {
                    $this->model   = $model;
                    $this->columns = $columns;
                }

                public function query()
                {
                    return $this->model::query()->select($this->columns);
                }

                public function headings(): array
                {
                    return $this->columns;
                }
            },
            "export.csv"
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PDF EXPORT
    |--------------------------------------------------------------------------
    */

    public function exportPdf($module)
    {
        $model   = $this->resolveModel($module);
        $columns = $this->resolveColumns($module);

        $reportData = $model::query()
            ->select($columns)
            ->get();

        $html = view('shared::pdf.report', [
			'reportTitle'	=> ucfirst($module) . ' Report',
			'tenantName'	=> '',
			'tenantByline'	=> '',
            'reportData'	=> $reportData,
            'columns'		=> $columns
        ])->render();

        $mpdf = new Mpdf([
            'mode'   => 'utf-8',
            'format' => 'A4',
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="export.pdf"');
    }
}