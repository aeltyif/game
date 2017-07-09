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
        if(count($models)) {
            foreach ($models as $model) {
                $character->with($model);
            }
        }
        return $character->get();
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
        $character = Character::find($id)->delete();
        return response([
            'message' => 'You deleted a character'
        ]);
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
