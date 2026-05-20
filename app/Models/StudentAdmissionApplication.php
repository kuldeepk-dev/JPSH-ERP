<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAdmissionApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'user_id',
        'student_id',
        'school_id',
        'academic_id',
        'status',
        'data_json',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];
}
