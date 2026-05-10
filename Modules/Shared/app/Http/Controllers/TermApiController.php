<?php

namespace Modules\Shared\Http\Controllers;

use Modules\Shared\Models\Term;
use Modules\Shared\Http\Controllers\SharedApiController;

class TermApiController extends SharedApiController
{
	protected $searchable = ['group'];

    protected function model()
    {
        return Term::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [];
	}

	public function navigation()
{
    $terms = Term::query()

        ->select(
            'module',
            'group'
        )

        ->distinct()

        ->get();

    $modules = $terms

        ->groupBy('module')

        ->map(function ($items, $module) {

            return [

                'id' => $module,

                'name' => ucfirst($module),

                'groups' => $items

                    ->pluck('group')

                    ->unique()

                    ->values()

                    ->map(function ($group) {

                        return [

                            'id' => $group,

                            'name' => ucfirst($group),
                        ];
                    }),
            ];
        })

        ->values();

    return response()->json([

        'status' => 'success',

        'data' => [
            'modules' => $modules,
        ],
    ]);
}

}
