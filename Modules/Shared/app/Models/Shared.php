<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Shared\Database\Factories\SharedFactory;

class Shared extends Model
{
    use HasFactory;

	protected $connection = 'mysql'; // Always use mysql connection

    /**
     * If the primary key is not auto-incrementing, set this to false.
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): SharedFactory
    // {
    //     // return SharedFactory::new();
    // }
}
