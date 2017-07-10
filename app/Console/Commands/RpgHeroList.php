<?php

namespace App\Console\Commands;

use App\Hero;
use Illuminate\Console\Command;

class RpgHeroList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:heroList';

    /**
     * The headers for the list tabled
     * @var array
     */
    protected $headers = ['ID', 'Hero Name', 'Description'];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->table($this->headers, Hero::orderBy('id', 'asc')->get()->toArray());
    }
}
