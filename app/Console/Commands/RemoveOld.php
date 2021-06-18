<?php

namespace App\Console\Commands;

use App\Models\Feed;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveOld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old data';

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
     * @return int
     */
    public function handle()
    {
        Feed::where('created_at', '<',
            Carbon::now()->subDays(30)->toDateTimeString())
            ->delete();
    }
}
