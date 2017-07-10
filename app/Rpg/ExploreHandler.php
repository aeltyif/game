<?php

namespace App\Rpg;

use App\Villain;
use App\Character;

class ExploreHandler
{
    /**
     * This method will tell you if you have found a challenger from exploring or not
     *
     * @param  Character $character
     * @return array
     */
    public function start(Character $character,MatchHandler $handler) : array
    {
        $random = rand();
        $result = ['code' => '','villain' => ''];
        $villains = Villain::orderBy('mod', 'desc')->get();
        foreach($villains as $villain) {
            if($random % $villain->mod == 0) {
                $result['villain'] = [
                    'name' => $villain->name,
                    'description' => $villain->description,
                    'increment' => $villain->level_increment,
                ];
                $result['code'] = $handler->make($character->id, $character->hero_id, $villain->id);
                break;
            }
        }
        return $result;
    }
}
