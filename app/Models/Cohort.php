<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['school_id', 'name', 'description','number_of_students', 'start_date', 'end_date'];
    public function students()
    {
        return $this->belongsToMany(User::class, 'cohort_student', 'cohort_id', 'student_id');
    }


}
