<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'characters';
    protected $fillable = array('id', 'hero_id', 'name', 'level');
    protected $hidden = array('hero_id', 'created_at', 'updated_at');

    /**
     * Return the hero object for this match
     *
     * @return [type] [description]
     */
    public function hero()
    {
        return $this->hasOne('App\Hero', 'id', 'hero_id');
    }
}
