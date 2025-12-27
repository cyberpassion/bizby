<?php

namespace Modules\Examresult\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// ✅ Import models
use Modules\Examresult\Models\ExamresultEvaluation;
use Modules\Examresult\Models\ExamresultEvaluationComponent;
use Modules\Examresult\Models\ExamresultEvaluationResult;

class ExamresultSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // Create 3 evaluations (exams / tests)
            ExamresultEvaluation::factory()
                ->count(3)
                ->create()
                ->each(function ($evaluation) {

                    // Create 5 components (subjects / sections) per evaluation
                    $components = ExamresultEvaluationComponent::factory()
                        ->count(5)
                        ->create([
                            'evaluation_id' => $evaluation->id,
                        ]);

                    // Create 30 results per component (students / entities)
                    foreach ($components as $component) {
                        ExamresultEvaluationResult::factory()
                            ->count(30)
                            ->create([
                                'evaluation_id' => $evaluation->id,
                                'evaluation_component_id' => $component->id,
                            ]);
                    }
                });

        });
    }
}
