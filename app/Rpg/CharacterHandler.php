<?php

namespace App\Rpg;

use App\Character;
use Illuminate\Http\Response;

class CharacterHandler
{
    /**
     * Display the specified resource.
     *
     * @return Collection
     */
    public static function list(array $models = [])
    {
        $character = Character::orderBy('id', 'asc');
        if (count($models)) {
            foreach ($models as $model) {
                $character->with($model);
            }
        }
        return $character->get();
    }

    /**
     * Create new character
     *
     * @param  int $hero_id
     * @param  string $name
     * @return array
     */
    public static function store(int $hero_id, string $name) : array
    {
        $response = [
            'code' => 500,
            'message' => 'Failed to create character',
        ];

        $character = new Character;
        $character->hero_id = $hero_id;
        $character->name = $name;

        //-- Prevent the save method from throwing an exception
        try {
            if ($character->save()) {
                $response['id'] = $character->id;
                $response['code'] = 201;
                $response['message'] = 'Created new character';
            }
        } catch (\Exception $e) {
            //-- Do nothing
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Collection
     */
    public static function show(int $id)
    {
        return Character::with('hero')->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Collection
     */
    public static function destroy(int $id)
    {
        $response['message'] = 'No such character exists';

        $character = Character::find($id);
        if (null != $character) {
            $character->delete();
            $response['message'] = 'You deleted a character';
        }

        return $response;
    }

    /**
     * Levelup your characters
     *
     * @param  int    $id
     * @param  int    $increment
     */
    public static function levelUp(int $id, int $increment)
    {
        $character = Character::find($id);
        $character->level += $increment;
        $character->save();
    }
}
