<?php

namespace App\Rpg;

class FightHandler
{
    /**
     * @var Pack\Hero
     */
    protected $hero;
    /**
     * @var Pack\Villain
     */
    protected $villain;

    /**
     * @var string
     */
    protected $prefix = 'App\Rpg\Types\\';

    /**
     * Instantiate both fighters classes to be used in fight
     *
     * @param AppMatch $data
     */
    public function __construct(\App\Match $data)
    {
        $hero_class = $this->prefix . 'Hero\\' . $data->hero->name;
        $villain_class = $this->prefix . 'Villain\\' . $data->villain->name;

        if(class_exists($hero_class) && class_exists($villain_class)) {
            $this->hero = new $hero_class();
            $this->villain = new $villain_class();
        } else {
            throw new \Exception("Classes do not exist", 1);
        }
    }

    /**
     * Use both fighters ability and send back the winner
     *
     * @return array [result, rolls]
     */
    public function fight() : array
    {
        $result['outcome'] = 1;
        $result['rolls'][] = $this->hero->ability();
        $result['rolls'][] = $this->villain->ability();

        if($result['rolls'][0] > $result['rolls'][1]) {
            $result['outcome'] = 2;
        }

        return $result;
    }
}
