<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Shared extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // Always use mysql connection

	// Specify the custom table name
    protected $table = 'cyp_shared';

}
