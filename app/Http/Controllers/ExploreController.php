<?php

namespace App\Http\Controllers;

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
        $handler = new Rpg\ExploreHandler;
        return $handler->start($request->id);
    }
}
