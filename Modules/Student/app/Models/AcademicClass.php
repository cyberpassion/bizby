<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'academic_level_id',
        'section',
    ];

    protected static function newFactory()
    {
        return \Modules\Student\Database\Factories\AcademicClassFactory::new();
    }

    public function level()
    {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'academic_class_id');
    }

    public function histories()
    {
        return $this->hasMany(StudentClassHistory::class, 'academic_class_id');
    }
}
