<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RpgDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the unwated characters';

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