<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $table = 'heroes';
    protected $fillable = array('id', 'name', 'description');
    protected $hidden = array('created_at', 'updated_at');
}
