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
        $handler = new Rpg\CharacterHandler();
        $create = $handler->store(1, 'Mazok' . rand());
        $this->assertInstanceOf('App\Character', $create);
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
        $handler = new Rpg\CharacterHandler();
        try {
            $response = $handler->store(1, Character::find($id)->name);
        } catch (\Exception $e) {
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
        $handler = new Rpg\CharacterHandler();
        $delete = $handler->destroy($id);
        $this->assertTrue($delete);
    }
}
