<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PermissionTreeApiController extends Controller
{
    public function index()
    {
        $permissions = DB::table('permission_permissions')
            ->orderBy('module')
            ->orderBy('operation')
            ->get();

        $tree = [];

        foreach ($permissions as $p) {
            if ($p->operation === '*') {
                $tree[$p->module] = [
                    'id' => $p->id,
                    'slug' => $p->slug,
                    'children' => []
                ];
            }
        }

        foreach ($permissions as $p) {
            if ($p->operation !== '*') {
                $tree[$p->module]['children'][] = [
                    'id' => $p->id,
                    'slug' => $p->slug,
                ];
            }
        }

        return array_values($tree);
    }
}
