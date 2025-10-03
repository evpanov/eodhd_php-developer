<?php

namespace App\Console\Commands;

use App\Services\EODETLService\CsvDownloader;
use App\Services\EODETLService\CsvExtractor;
use App\Services\EODETLService\EODETLService;
use App\Services\EODETLService\Repositories\TickerRepository;
use Illuminate\Console\Command;

class EODETLCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eodetl:run';

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
        $this->info(__CLASS__ . ' has been started at ' . date('Y-m-d H:i:s'));

        $service = new EODETLService(
            new TickerRepository(),
            new CsvDownloader(),
            new CsvExtractor(),
            new \DateTime('-1 day')
        );

        $service->run();

        $this->info(__CLASS__ . ' has been finished at ' . date('Y-m-d H:i:s'));
    }
}
