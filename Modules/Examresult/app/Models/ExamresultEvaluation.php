<?php

namespace Modules\Examresult\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamresultEvaluation extends Model
{
    use HasFactory;

    protected $table = 'examresult_evaluations';

    protected $fillable = [
        'name',
        'type',
        'group_code',
        'sequence',
        'evaluation_date',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'evaluation_date' => 'date',
    ];

    /* =========================
     | Relationships
     |=========================*/

    public function components()
    {
        return $this->hasMany(
            ExamresultEvaluationComponent::class,
            'evaluation_id'
        );
    }

    public function results()
    {
        return $this->hasMany(
            ExamresultEvaluationResult::class,
            'evaluation_id'
        );
    }
}
