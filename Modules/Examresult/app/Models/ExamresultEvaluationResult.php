<?php

namespace Modules\Examresult\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamresultEvaluationResult extends Model
{
    use HasFactory;

    protected $table = 'examresult_evaluation_results';

    protected $fillable = [
        'evaluation_id',
        'evaluation_component_id',
        'entity_id',
        'entity_type',
        'score',
        'max_score',
        'grade',
        'status',
        'remark',
    ];

    /* =========================
     | Relationships
     |=========================*/

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
