<?php

namespace App\Console\Commands;

use App\Character;
use App\Rpg as Rpg;
use Illuminate\Console\Command;

class RpgExplore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:explore {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start exploring your way into the game';

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
        $handler = new Rpg\ExploreHandler;
        $response = $handler->start(Character::find($this->argument('id')), new Rpg\MatchHandler);

        $message = 'We could not find you a challenger try again';
        if(!empty($response['code'])) {
            $message = 'We have found you a new challenger, match code : ' . $response['code'];
        }
        $this->alert($message);
    }
}
