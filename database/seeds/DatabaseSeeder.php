<?php

use App\Hero;
use App\Villain;
use App\Character;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //-- Heros
        Hero::Create([
            'name' => 'Assasin',
            'description' => 'This class wield two swords, he has the ability to use stealth'
        ]);
        Hero::Create([
            'name' => 'Gunner',
            'description' => 'This class wield one rifle, he has the ability to use gun powder'
        ]);
        Hero::Create([
            'name' => 'Wizard',
            'description' => 'This class wield magic staff, he has the ability to use magic'
        ]);

        //-- Villians
        Villain::Create([
            'name' => 'Bird',
            'description' => 'This Bird is unlucky he roll low dice rolls',
            'level_increment' => 1,
            'mod' => 2
        ]);
        Villain::Create([
            'name' => 'Troll',
            'description' => 'This Troll is unlucky but sometimes he is',
            'level_increment' => 2,
            'mod' => 3
        ]);
        Villain::Create([
            'name' => 'Rock',
            'description' => 'This Rock is tough opponent',
            'level_increment' => 3,
            'mod' => 5
        ]);
        Villain::Create([
            'name' => 'Boss',
            'description' => 'This villain is lucky he roll high dice rolls',
            'level_increment' => 4,
            'mod' => 7
        ]);

        //-- Characters to play with
        Character::Create([
            'hero_id' => 1,
            'name' => 'Mazok'
        ]);
        Character::Create([
            'hero_id' => 2,
            'name' => 'Ghost'
        ]);
        Character::Create([
            'hero_id' => 3,
            'name' => 'Hina'
        ]);
    }
}
