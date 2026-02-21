<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Mpdf\Mpdf;
use Modules\Shared\Models\PublicReport;
use Modules\Shared\Services\ReportRegistry;
use Modules\Shared\Services\LookupRegistry;

class ReportPublicApiController extends Controller
{
    public function publicPreview($token)
    {
        // 1️⃣ CENTRAL DB lookup (PublicReport must use central connection)
        $publicReport = PublicReport::where('token', $token)->firstOrFail();

        abort_unless($publicReport->is_active, 404);

        abort_if(
            $publicReport->expires_at && now()->gt($publicReport->expires_at),
            403,
            'Link expired'
        );

        // 2️⃣ Centralized domain validation ✅
        ReportRegistry::validateDomain($publicReport->allowed_domain);

        // 3️⃣ Tenant initialization (AFTER token resolution) ✅
        abort_unless($publicReport->tenant_id, 404);

        tenancy()->initialize($publicReport->tenant_id);

        // 4️⃣ Centralized module → model resolution ✅
        $modelClass = ReportRegistry::resolveModel($publicReport->module);

        $defaultColumns = LookupRegistry::get("{$publicReport->module}.columns.report");

        $reportData = $this->applyFilters(
            $modelClass::query(),
            $publicReport->filters ?? []
        )->get();

        $mpdf = new Mpdf([
            'mode'   => 'utf-8',
            'format' => 'A4',
        ]);

        $html = view('shared::pdf.report', [
            'reportTitle'  => ucfirst($publicReport->module) . ' Report',
            'reportData'   => $reportData,
            'tenantName'   => '',
            'tenantByline' => '',
            'columns'      => !empty($publicReport->filters)
                ? array_keys($publicReport->filters)
                : $defaultColumns,
        ])->render();

        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN)
        )
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="report.pdf"');
    }

    /*
    |--------------------------------------------------------------------------
    | Generic Filter Engine
    |--------------------------------------------------------------------------
    */

    protected function applyFilters($query, array $filters)
    {
        foreach ($filters as $column => $value) {

            if (is_null($value) || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $query->whereIn($column, $value);
                continue;
            }

            if ($column === 'date_from') {
                $query->whereDate('created_at', '>=', $value);
                continue;
            }

            if ($column === 'date_to') {
                $query->whereDate('created_at', '<=', $value);
                continue;
            }

            $query->where($column, $value);
        }

        return $query;
    }

    public function generate($module)
    {
        $tenant = app('resolvedTenant');

        $publicReport = PublicReport::firstOrCreate([
            'module'    => $module,
            'tenant_id' => $tenant->id ?? null,
        ]);

        return response()->json([
            'url' => route('api.reports.public', [
                'token' => $publicReport->token
            ])
        ]);
    }
}