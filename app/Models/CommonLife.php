<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonLife extends Model
{
    protected $table = 'CommonLife_Table';
    protected $fillable     = ['StudentID', 'Task','Status','Commentary'];
    //
}
