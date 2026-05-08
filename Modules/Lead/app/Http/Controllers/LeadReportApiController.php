<?php

namespace Modules\Lead\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

use Modules\Lead\Models\Lead;

class LeadReportApiController extends Controller
{
	/* ---------------------------------------------------------
	 | Generic Report
	 * --------------------------------------------------------*/
	public function index(Request $request)
	{
		$request->validate([
			'report_type' => 'nullable|string',

			'from_date'   => 'nullable|date',
			'to_date'     => 'nullable|date',

			'state'       => 'nullable|string',
			'district'    => 'nullable|string',

			'business_type' => 'nullable|string',

			'source_id'   => 'nullable|string',
			'stage_id'    => 'nullable|string',

			'mode'        => 'nullable|string',

			'assigned_to' => 'nullable',
			'generated_by'=> 'nullable',

			'next_followup_from' => 'nullable|date',
			'next_followup_to'   => 'nullable|date',

			'is_existing_client' => 'nullable',

			'status' => 'nullable',

			'minimum_followups' => 'nullable|integer',

			'aging_days' => 'nullable|integer',

			'group_by' => 'nullable|string',

			'followup_mode' => 'nullable|string',
		]);

		$query = Lead::query()

			->where(
				'tenant_id',
				tenant()->id
			)

			->with([
				'followups',
				'assignedTo',
				'generatedBy',
			]);

		/* ---------------------------------------------------------
		 | Date Range
		 * --------------------------------------------------------*/

		if (
			$request->filled('from_date') &&
			$request->filled('to_date')
		) {
			$query->whereBetween(
				'lead_date',
				[
					$request->from_date,
					$request->to_date
				]
			);
		}

		/* ---------------------------------------------------------
		 | Location
		 * --------------------------------------------------------*/

		if ($request->filled('state')) {
			$query->where(
				'state',
				$request->state
			);
		}

		if ($request->filled('district')) {
			$query->where(
				'district',
				'LIKE',
				"%{$request->district}%"
			);
		}

		/* ---------------------------------------------------------
		 | Business
		 * --------------------------------------------------------*/

		if ($request->filled('business_type')) {
			$query->where(
				'business_type',
				$request->business_type
			);
		}

		/* ---------------------------------------------------------
		 | Source / Stage
		 * --------------------------------------------------------*/

		if ($request->filled('source_id')) {
			$query->where(
				'source_id',
				$request->source_id
			);
		}

		if ($request->filled('stage_id')) {
			$query->where(
				'stage_id',
				$request->stage_id
			);
		}

		/* ---------------------------------------------------------
		 | Mode
		 * --------------------------------------------------------*/

		if ($request->filled('mode')) {
			$query->where(
				'mode',
				$request->mode
			);
		}

		/* ---------------------------------------------------------
		 | Assigned / Generated
		 * --------------------------------------------------------*/

		if ($request->filled('assigned_to')) {

			$query->where(
				'assigned_to_id',
				$request->assigned_to
			);
		}

		if ($request->filled('generated_by')) {

			$query->where(
				'generated_by_id',
				$request->generated_by
			);
		}

		/* ---------------------------------------------------------
		 | Existing Client
		 * --------------------------------------------------------*/

		if (
			$request->filled(
				'is_existing_client'
			)
		) {
			$query->where(
				'is_existing_client',
				$request->is_existing_client
			);
		}

		/* ---------------------------------------------------------
		 | Status
		 * --------------------------------------------------------*/

		if ($request->filled('status')) {

			$query->where(
				'status',
				$request->status
			);
		}

		/* ---------------------------------------------------------
		 | Follow-up Date
		 * --------------------------------------------------------*/

		if (
			$request->filled(
				'next_followup_from'
			)
		) {
			$query->whereDate(
				'next_followup_date',
				'>=',
				$request->next_followup_from
			);
		}

		if (
			$request->filled(
				'next_followup_to'
			)
		) {
			$query->whereDate(
				'next_followup_date',
				'<=',
				$request->next_followup_to
			);
		}

		/* ---------------------------------------------------------
		 | Minimum Follow-ups
		 * --------------------------------------------------------*/

		if (
			$request->filled(
				'minimum_followups'
			)
		) {
			$query->has(
				'followups',
				'>=',
				$request->minimum_followups
			);
		}

		/* ---------------------------------------------------------
		 | Aging
		 * --------------------------------------------------------*/

		if ($request->filled('aging_days')) {

			$query->whereDate(
				'created_at',
				'<=',
				now()->subDays(
					$request->aging_days
				)
			);
		}

		/* ---------------------------------------------------------
		 | Follow-up Mode
		 * --------------------------------------------------------*/

		if (
			$request->filled(
				'followup_mode'
			)
		) {
			$query->whereHas(
				'followups',
				fn ($q) =>
					$q->where(
						'mode',
						$request->followup_mode
					)
			);
		}

		/* ---------------------------------------------------------
		 | Sorting
		 * --------------------------------------------------------*/

		$query->latest();

		$data = $query->get();

		/* ---------------------------------------------------------
		 | Grouping
		 * --------------------------------------------------------*/

		if ($request->filled('group_by')) {

			$grouped = $data->groupBy(
				$request->group_by
			);

			return response()->json([
				'status'  => 'success',

				'message' =>
					'Grouped report fetched successfully.',

				'group_by' =>
					$request->group_by,

				'data' => $grouped,
			], Response::HTTP_OK);
		}

		/* ---------------------------------------------------------
		 | Default Response
		 * --------------------------------------------------------*/

		return response()->json([
			'status'  => 'success',

			'message' =>
				'Lead report fetched successfully.',

			'total' => $data->count(),

			'data' => [
				'data' => $data
			],
		], Response::HTTP_OK);
	}
}