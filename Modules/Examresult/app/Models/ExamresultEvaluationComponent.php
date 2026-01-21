<?php

namespace Modules\Examresult\Models;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamresultEvaluationComponent extends TenantModel
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
