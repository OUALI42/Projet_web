<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'Group_Table';
    protected $fillable     = ['name', 'description','Date_of_creation'];
    //
}
