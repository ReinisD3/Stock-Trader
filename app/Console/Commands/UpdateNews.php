<?php

namespace App\Console\Commands;

use App\Repositories\StockRepository;
use Illuminate\Console\Command;

class UpdateNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load latest news from API ';
    private StockRepository $repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StockRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $marketNews =$this->repository->getMarketNews('general');
        cache()->put('marketNews', $marketNews);
//        return Command::SUCCESS;
    }
}
