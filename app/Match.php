<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';
    protected $fillable = array('id', 'character_id', 'villain_id', 'code', 'result');

    /**
     * Return the hero object for this match
     *
     * @return [type] [description]
     */
    public function hero()
    {
        return $this->hasOne('App\Hero', 'id', 'hero_id');
    }

    /**
     * Return the villain object for this match
     *
     * @return [type] [description]
     */
    public function villain()
    {
        return $this->hasOne('App\Villain', 'id', 'villain_id');
    }
}
