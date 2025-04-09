<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'Students_table';
    protected $fillable     = ['name', 'surname','date_of_birth'];

}
