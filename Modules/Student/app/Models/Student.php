<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Student extends Model
{
    use HasFactory;

    // dynamically allow all columns except id, timestamps, deleted_at
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function academicHistories()
    {
        return $this->hasMany(StudentAcademicHistory::class, 'student_id');
    }

    public function currentAcademicHistory()
    {
        return $this->hasOne(StudentAcademicHistory::class, 'student_id')->where('is_current', true);
    }
}
