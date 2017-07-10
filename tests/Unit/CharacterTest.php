<?php

namespace Tests\Unit;


use App\Character;
use Tests\TestCase;
use App\Rpg as Rpg;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CharacterTest extends TestCase
{
    /**
     * This method will run before each testcase
     */
    public function setUp()
    {
        parent::setUp();
        $this->createApplication();
    }
    /**
     * Can we create a new character
     *
     * @return void
     */
    public function testCreateCharacter()
    {
        $create = Rpg\CharacterHandler::store(1, 'Mazok' . rand());
        $this->assertEquals($create['code'], 201);
        return $create['id'];
    }

    /**
     * Can we create a duplicated character
     *
     * @return void
     * @depends testCreateCharacter
     */
    public function testCreateDuplicateCharacter($id)
    {
        $error_code = 0;
        try{
            Rpg\CharacterHandler::store(1, Character::find($id)->name);
        } catch(\Exception $e) {
            $error_code = $e->getCode();
        }
        $this->assertEquals($error_code, 23000);
    }

    /**
     * Can we explore
     *
     * @return void
     * @depends testCreateCharacter
     */
    public function testExploreGame($id)
    {
        $handler = new Rpg\ExploreHandler;
        $result = $handler->start(Character::find($id), new Rpg\MatchHandler);
        $this->assertArrayHasKey('code', $result);
        return $result;
    }

    /**
     * Can we fight
     *
     * @return void
     * @depends testExploreGame
     */
    public function testFighting($match)
    {
        $handler = new Rpg\MatchHandler;
        $result = $handler->process($match['code']);
        $this->assertArrayHasKey('outcome', $result);
    }

    /**
     * Can we delete a character
     *
     * @return void
     * @depends testCreateCharacter
     */
    public function testDeleteCharacter($id)
    {
        $delete = Rpg\CharacterHandler::destroy($id);
        $this->assertEquals($delete['message'], 'You deleted a character');
    }
}
