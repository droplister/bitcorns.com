<?php

namespace App\Console\Commands;

use App\Jobs\BitcornBattleAchievements;
use Illuminate\Console\Command;

class BitcornBattle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitcorn:battle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bitcorn Battle Stats';

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
        BitcornBattleAchievements::dispatch();
    }
}