<?php

namespace App\Rpg;

trait Component
{
    /**
     * Generate random unique string
     *
     * @param  string $prefix
     * @param  int    $id
     * @return string
     */
    public function generateCode(string $prefix, int $id) : string
    {
        return uniqid($prefix . $id, false);
    }
}
