<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use Modules\Admin\Models\Tenants\TenantModule;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TenantModuleApiController extends SharedApiController
{
    protected function model()
    {
        return TenantModule::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'module_key'  => 'required|string',
            'module_name' => 'required|string',
            'is_paid'     => 'boolean',
            'price'       => 'nullable|numeric',
            'valid_till'  => 'nullable|date',
            'config'      => 'nullable|array',
        ];
    }

    /**
     * List all modules for a tenant
     */
    public function index1(Request $request, $tenantId)
    {
        $modules = TenantModule::where('tenant_id', $tenantId)->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Modules fetched successfully.',
            'data'    => $modules
        ]);
    }

    /**
     * Activate or add a module
     */
    public function activateSingle(Request $request, $tenantId)
    {
        $validated = $request->validate($this->validationRules());

        $module = TenantModule::updateOrCreate(
            [
                'tenant_id'  => $tenantId,
                'module_key' => $validated['module_key'],
            ],
            array_merge($validated, [
                'activated_at'   => now(),
                'deactivated_at' => null
            ])
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Module activated successfully.',
            'data'    => $module
        ]);
    }

	public function activateMultiple(Request $request, $tenantId)
	{
    	$modules = $request->input('modules'); // Expecting an array

	    if (!is_array($modules) || empty($modules)) {
    	    return response()->json([
        	    'status'  => 'error',
            	'message' => 'Modules array is required.',
            	'data'    => null
	        ]);
    	}

	    $activatedModules = [];

	    foreach ($modules as $moduleData) {
    	    $validator = Validator::make($moduleData, $this->validationRules());

	        if ($validator->fails()) {
    	        return response()->json([
        	        'status'  => 'error',
            	    'message' => 'Validation failed for one or more modules.',
                	'errors'  => $validator->errors(),
                	'data'    => null
	            ]);
    	    }

        	$module = TenantModule::updateOrCreate(
            	[
                	'tenant_id'  => $tenantId,
                	'module_key' => $moduleData['module_key'],
	            ],
    	        array_merge($moduleData, [
        	        'activated_at'   => now(),
            	    'deactivated_at' => null
            	])
        	);

	        $activatedModules[] = $module;
    	}

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Modules activated successfully.',
        	'data'    => $activatedModules
    	]);
	}

    /**
     * Deactivate a module
     */
    public function deactivate($tenantId, $moduleId)
    {
        $module = TenantModule::where('tenant_id', $tenantId)
            ->where('id', $moduleId)
            ->first();

        if (!$module) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Module not found.',
                'data'    => null
            ]);
        }

        $module->update([
            'deactivated_at' => now()
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Module deactivated successfully.',
            'data'    => $module
        ]);
    }

    /**
     * Extra stats (example: active paid modules count)
     */
    public function extraStats()
    {
        $premiumModules = TenantModule::where('is_paid', true)
            ->whereNotNull('activated_at')
            ->whereNull('deactivated_at')
            ->count();

        return [
            'premium_modules' => $premiumModules,
        ];
    }
}
