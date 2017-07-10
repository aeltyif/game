<?php

namespace App\Console\Commands;

use App\Rpg as Rpg;
use Illuminate\Console\Command;

class RpgMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:make {name}{hero_type_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new character';

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
        $message = '';
        $character = Rpg\CharacterHandler::store($this->argument('hero_type_id'), $this->argument('name'));
        $message = $character['message'];
        if($character['code'] == 201) {
            $message .= ' With ID : ' . $character['id'];
        }
        $this->alert($message);
    }
}
