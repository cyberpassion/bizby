<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

class Term extends Model
{
	use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'group_name',
        'linked_module',
        'sort_order',
        'status',
    ];
}
