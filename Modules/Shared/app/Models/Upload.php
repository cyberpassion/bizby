<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upload extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'cyp_upload';
    protected $primaryKey = 'id';
    public $incrementing = true;

    // ✅ Mass-assignable fields
    protected $fillable = [
		'reference_type',
        'reference_id',
        'file_key',
        'document_path',
    ];
}
