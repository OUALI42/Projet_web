<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retros extends Model
{
    protected $table = 'Retros_Table';
    protected $fillable     = ['Teacher_id', 'Name_of_Promotion','Retro'];

}
