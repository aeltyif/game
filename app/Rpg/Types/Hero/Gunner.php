<?php

namespace App\Rpg\Types\Hero;

use App\Rpg\Types as Types;

class Gunner implements Types\TypeInterface
{
    /**
     * Do the action of the chosen class
     *
     * @return int
     */
    public function ability() : int
    {
        return max([rand(1, 6), rand(1, 6)]);
    }
}
