<?php

namespace Modules\Examresult\Models;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamresultEvaluationResult extends TenantModel
{
    use HasFactory;

    protected $table = 'examresult_evaluation_results';

    protected $fillable = [
        'tenant_id',
        'evaluation_id',
        'evaluation_component_id',
        'entity_id',
        'entity_type',
        'score',
        'max_score',
        'grade',
        'result_status',
    ];

    public function evaluation()
    {
        return $this->belongsTo(
            ExamresultEvaluation::class,
            'evaluation_id'
        );
    }

    public function component()
    {
        return $this->belongsTo(
            ExamresultEvaluationComponent::class,
            'evaluation_component_id'
        );
    }

    public function entity()
    {
        return $this->morphTo();
    }
}
