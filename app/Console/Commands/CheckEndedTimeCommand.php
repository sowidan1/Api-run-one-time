<?php

namespace App\Console\Commands;

use App\Http\Controllers\OsamaController;
use App\Models\TimeDelete;
use Illuminate\Console\Command;

class CheckEndedTimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-ended-time-command';
    protected $time;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command is for check ended time for every minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (empty($this->time)) {

            $this->time = TimeDelete::pluck('end_time')->first();

            cache()->put('end_time', $this->time);
        }

        $now = now()->startOfSecond();
        $cache_date = cache()->get('end_time');

        if ($cache_date != NULL && $cache_date <= $now) {

            $controller = new OsamaController();

            $reflection = new \ReflectionMethod($controller, 'timeDelete');
            $filePath = $reflection->getFileName();
            $functionName = $reflection->getName();

            $controller->callScript($filePath, $functionName);

            cache()->forget('end_time');
        }
        $this->info('Command executed successfully .');
    }
}
