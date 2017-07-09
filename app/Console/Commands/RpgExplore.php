<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RpgExplore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:explore';

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
        //
    }
}
