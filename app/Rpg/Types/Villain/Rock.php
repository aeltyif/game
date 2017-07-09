<?php

namespace App\Rpg\Types\Villain;

use \App\Rpg\Types as Types;

class Rock implements Types\TypeInterface
{
    /**
     * Do the action of the chosen class
     *
     * @return int
     */
    public function ability() : int
    {
        return rand(3, 5);
    }
}
