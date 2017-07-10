<?php

namespace App\Http\Controllers;

use App\Character;
use App\Rpg as Rpg;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Return boolean if exploring created match record.
     *
     * @param  Request $request
     * @return array
     */
    public function index(Request $request) : array
    {
        $response = [];

        $handler = new Rpg\ExploreHandler;
        $response = $handler->start(Character::find($request->id), new Rpg\MatchHandler);

        return $response;
    }
}
