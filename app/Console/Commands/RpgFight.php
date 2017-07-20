<?php

namespace App\Console\Commands;

use App\Rpg as Rpg;
use Illuminate\Console\Command;

class RpgFight extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:fight {match_code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the command of fighting';

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
        $match = new Rpg\MatchHandler();
        $results = $match->process($this->argument('match_code'));

        $rolls = ', you rolled : ' . $results['rolls'][0] . ' , opponent : ' . $results['rolls'][1];

        switch ($results['outcome']) {
            case 1:
                $message = 'You have Lost' . $rolls;
                break;
            case 2:
                $message = 'You have Won' . $rolls;
                break;
            default:
                $message = 'Match not found, use rpg:explore {character_id} to find new challenge';
                break;
        }

        $this->alert($message);
    }
}
