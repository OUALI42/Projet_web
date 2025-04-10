<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $table = 'Knowledge_Table';
    protected $fillable     = ['IdStudent', 'Skill','Description','Status'];
}
