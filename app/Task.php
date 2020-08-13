<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //giardar datos en el campo correspondiente
    protected $fillable = ['keep'];
}
