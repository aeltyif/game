<?php

namespace App\Rpg;

use App\Character;
use App\Villain;

class ExploreHandler
{
    /**
     * This method will tell you if you have found a challenger from exploring or not
     *
     * @param  int    $character_id
     * @return array
     */
    public function start(int $character_id) : array
    {
        $result = ['code' => '','villain' => ''];
        //-- Check if the character is real
        $character = Character::find($character_id);
        if(null !== $character) {
            $random = rand();
            $villains = Villain::orderBy('mod', 'desc')->get();
            foreach($villains as $villain) {
                if($random % $villain->mod == 0) {
                    $result['villain'] = [
                        'name' => $villain->name,
                        'description' => $villain->description,
                        'increment' => $villain->level_increment,
                    ];
                    $handler = new MatchHandler();
                    $result['code'] = $handler->make($character->id, $character->hero_id, $villain->id);
                    break;
                }
            }
        }
        return $result;
    }
}
