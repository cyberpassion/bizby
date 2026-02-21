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
        $columns    = $this->resolveColumns($module);

        return Excel::download(
            new class($modelClass, $columns) implements FromQuery, WithHeadings {

                protected string $modelClass;
                protected array  $columns;

                public function __construct(string $modelClass, array $columns)
                {
                    $this->modelClass = $modelClass;
                    $this->columns    = $columns;
                }

                public function query()
                {
                    return $this->modelClass::query()
                        ->select($this->columns);
                }

                public function headings(): array
                {
                    return $this->columns;
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
        $columns    = $this->resolveColumns($module);

        $reportData = $modelClass::query()
            ->select($columns)
            ->get();

        $html = view('shared::pdf.report', [
            'reportTitle'  => ucfirst($module) . ' Report',
            'tenantName'   => '',
            'tenantByline' => '',
            'reportData'   => $reportData,
            'columns'      => $columns,
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