<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teachers_Cohorts extends Model
{
    protected $table = 'Teachers_Cohorts';
    protected $fillable     = ['teacher_id', 'cohort_id','student_id'];
}
