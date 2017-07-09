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
        $response = [
            'code' => 201,
            'error' => false,
            'message' => 'Created new character',
        ];

        $character = new Character;
        $character->hero_id = $request->input('hero_id');
        $character->name = $request->input('name');

        if(!$character->save()) {
            $response['code'] = 500;
            $response['message'] = 'Failed to create character';
        }

        return response(['message' => $response['message']], $response['code']);
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
        return Rpg\CharacterHandler::destroy($request->id);
    }
}
