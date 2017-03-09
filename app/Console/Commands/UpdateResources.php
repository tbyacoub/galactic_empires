<?php

namespace App\Console\Commands;

use Activity;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resources:update';

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
     * Execute the command to update resources for all planets
     * Called every 5 minutes
     *
     * @return mixed
     */
    public function handle()
    {
      dispatch(new \App\Jobs\UpdateResources());

    }

}


