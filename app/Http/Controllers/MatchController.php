<?php

namespace App\Http\Controllers;

use App\Match;
use App\Rpg\MatchHandler;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $match = new MatchHandler();
        $results = $match->process($request->id);

        //-- You cannot fight unless a match is found
        if ($results['outcome'] === 0) {
            return response([
                'message' => 'No match was found'
            ], 404);
        }
        return $results;
    }
}
