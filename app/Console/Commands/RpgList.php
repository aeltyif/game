<?php

namespace App\Console\Commands;

use App\Rpg as Rpg;
use Illuminate\Console\Command;

class RpgList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display a list of characters';

    /**
     * The headers for the list tabled
     * @var array
     */
    protected $headers = ['ID', 'Hero ID', 'Character Name', 'Character Level'];

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
        $handler = new Rpg\CharacterHandler();
        $this->table($this->headers, $handler->list()->toArray());
    }
}
