<?php

namespace Modules\Examresult\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamresultEvaluationComponent extends Model
{
    use HasFactory;

    protected $table = 'examresult_evaluation_components';

    protected $fillable = [
        'evaluation_id',
        'name',
        'code',
        'max_score',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
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

    public function results()
    {
        return $this->hasMany(
            ExamresultEvaluationResult::class,
            'evaluation_component_id'
        );
    }
}
