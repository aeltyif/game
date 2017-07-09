<?php

namespace App\Rpg;

use App\Match;

class MatchHandler
{
    use Component;

    /**
     * Create new match and return the match generated unique code
     *
     * @param  int    $character_id
     * @param  int    $hero_id
     * @param  int    $villain_id
     * @return string
     */
    public function make(int $character_id, int $hero_id, int $villain_id) : string
    {
        $code = $this->generateCode('MTC', $character_id);
        $this->clean($character_id, $villain_id);

        $match = new Match;
        $match->character_id = $character_id;
        $match->hero_id = $hero_id;
        $match->villain_id = $villain_id;
        $match->code = $code;
        $match->save();

        return $code;
    }

    /**
     * This method will process the entire match and return its results
     *
     * @param  string $code
     * @return array
     */
    public function process(string $code) : array
    {
        $match_results = ['outcome' => 0, 'rolls' => [0, 0]];
        $match = Match::where('code', $code)->where('result', 0)->get();
        if(count($match)) {
            //-- Fight
            $contest = new FightHandler($match[0]);
            $match_results = $contest->fight();
            //-- Update
            $this->updateResult($match[0]->id, $match_results['outcome']);
            //-- Level Up
            if($match_results['outcome'] === 2) {
                CharacterHandler::levelUp($match[0]->character_id, $match[0]->villain->level_increment);
            }
        }
        return $match_results;
    }

    /**
     * Update the result of the match
     *
     * @param  int     $id
     * @param  int     $status
     * @return boolean
     */
    private function updateResult(int $id, int $status)
    {
        $match = Match::find($id);
        $match->result = $status;
        $match->code = '';
        $match->save();
    }

    /**
     * Clean up the unused matches
     * @param  int    $character_id
     * @param  int    $villain_id
     * @return int
     */
    private function clean(int $character_id, int $villain_id) : int
    {
        $match = Match::where('character_id', '=', $character_id)
                      ->where('result', '=', 0);
        return $match->delete();
    }
}
