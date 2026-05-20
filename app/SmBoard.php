<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmBoard extends Model
{
    protected $table = 'sm_boards';

    protected $fillable = [
        'name',
        'school_id',
        'active_status',
    ];
}
