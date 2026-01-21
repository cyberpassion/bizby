<?php

namespace Modules\Examresult\Models;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamresultEvaluation extends TenantModel
{
    use HasFactory;

    protected $table = 'examresult_evaluations';

    protected $fillable = [
        'tenant_id',
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
