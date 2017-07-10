<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RpgInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display welcome message with some tips on how to play the game';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment(
            "Welcome to the King Of Luck \n" .
            "You can start playing the game by using the following commands \n\n" .
            "rpg:list    will show you the list of characters you have created \n".
            "rpg:make    will will create new character \n".
            "rpg:explore will allow you explore the game but requires a valid character id \n".
            "rpg:fight   will allow you fight a villain but requires a valid match code \n".
            "rpg:delete  will allow you to delete a character you created \n\n".
            "rpg:matches will show you a list of the matches \n\n".
            "Good Luck, and have fun !!"
        );
    }
}
