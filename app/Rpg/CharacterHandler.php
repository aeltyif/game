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
    public function list(array $models = [])
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
     * @return Collection
     */
    public function store(int $hero_id, string $name)
    {
        $character = new Character;
        $character->hero_id = $hero_id;
        $character->name = $name;
        $character->save();
        return $character;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Collection
     */
    public function show(int $id)
    {
        return Character::with('hero')->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Collection
     */
    public function destroy(int $id)
    {
        return Character::find($id)->delete();
    }

    /**
     * Levelup your characters
     *
     * @param  int    $id
     * @param  int    $increment
     */
    public function levelUp(int $id, int $increment)
    {
        $character = Character::find($id);
        $character->level += $increment;
        $character->save();
    }
}
