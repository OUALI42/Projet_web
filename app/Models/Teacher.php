<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'Teachers_table';
    protected $fillable     = ['name', 'surname'];

}
