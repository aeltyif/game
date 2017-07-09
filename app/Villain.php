<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Villain extends Model
{
    protected $table = 'villains';
    protected $fillable = array('id', 'name', 'description', 'level_increment', 'mod');
}
