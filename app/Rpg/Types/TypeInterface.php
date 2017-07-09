<?php

namespace App\Rpg\Types;

interface TypeInterface
{
    /**
     * Use the hero/villain ability
     *
     * @return int the outcome of rolling your dice
     */
    public function ability() : int;
}
