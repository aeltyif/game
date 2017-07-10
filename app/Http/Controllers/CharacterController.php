<?php

namespace App\Http\Controllers;

use App\Character;
use App\Rpg as Rpg;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Rpg\CharacterHandler::list(['hero']);
    }

    /**
     * Store a newly created resource in storage.
     * This is a simple example of handling a proper HTTP response
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $store = Rpg\CharacterHandler::store($request->input('hero_id'), $request->input('name'));
        return response(['message' => $store['message']], $store['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return Collection
     */
    public function show(Request $request)
    {
        return Rpg\CharacterHandler::show($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        return response(Rpg\CharacterHandler::destroy($request->id));
    }
}
