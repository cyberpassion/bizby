<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_level_id',
        'name',
        'level_type',
        'order_no',
    ];

    protected static function newFactory()
    {
        return \Modules\Student\Database\Factories\AcademicLevelFactory::new();
    }

    public function classes()
    {
        return $this->hasMany(AcademicClass::class, 'academic_level_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'academic_level_id');
    }
}
