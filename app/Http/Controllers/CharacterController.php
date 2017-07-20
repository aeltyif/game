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
        $handler = new Rpg\CharacterHandler();
        return $handler->list(['hero']);
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
        $handler = new Rpg\CharacterHandler();
        $store = $handler->store($request->input('hero_id'), $request->input('name'));
        return response(['message' => 'Created new character'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return Collection
     */
    public function show(Request $request)
    {
        $handler = new Rpg\CharacterHandler();
        return $handler->show($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $handler = new Rpg\CharacterHandler();
        return response($handler->destroy($request->id));
    }
}
