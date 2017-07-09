<?php

namespace App\Rpg\Types\Hero;

use App\Rpg\Types as Types;

class Assasin implements Types\TypeInterface
{
    /**
     * Do the action of the chosen class
     *
     * @return int
     */
    public function ability() : int
    {
        return rand(1, 6);
    }
}
