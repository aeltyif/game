<?php

namespace App\Console\Commands;

use App\Rpg as Rpg;
use Illuminate\Console\Command;

class RpgMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display a list of the matches';

    /**
     * The headers for the list tabled
     * @var array
     */
    protected $headers = ['ID', 'Character ID', 'Hero ID', 'Villain ID', 'Match Code', 'Outcome'];

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
        $this->table($this->headers, Rpg\MatchHandler::list()->toArray());
    }
}
