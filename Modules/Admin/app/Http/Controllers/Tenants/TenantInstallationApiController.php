<?php
namespace Modules\Admin\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Admin\Enums\Tenants\TargetType;
use Modules\Admin\Enums\Tenants\OperationType;
use Modules\Admin\Models\Tenants\TenantInstallation;
use Modules\Admin\Services\Tenants\TenantInstallationRunner;

class TenantInstallationApiController extends Controller
{
    public function store(Request $request, TenantInstallationRunner $runner)
    {
        $install = TenantInstallation::create([
            'tenant_id' => $request->tenant_id,
            'target_type' => TargetType::from($request->target_type),
            'target_id' => $request->target_id,
            'target_key' => $request->target_key,
            'operation' => OperationType::from($request->operation),
            'config' => $request->config,
        ]);

        dispatch(function () use ($install, $runner) {
            $runner->run($install, function ($install) {
                // actual logic here
            });
        });

        return response()->json($install);
    }
}
