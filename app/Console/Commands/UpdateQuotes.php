<?php

namespace App\Console\Commands;

use App\Models\Trade\Trade;
use App\Repositories\StockRepository;
use Illuminate\Console\Command;

class UpdateQuotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting sock quotes for ShowTrades view ';
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
        $companySymbols = Trade::select('company_symbol')
            ->groupBy('company_symbol')
            ->get('company_symbol');
        $quotePrices = [];
        foreach ($companySymbols as $company) {
            $companySymbol = $company->company_symbol;
            $quotePrices[$companySymbol] = $this->repository->getPrice($companySymbol);
        }

        cache()->put('quotePrices', $quotePrices);
//        return Command::SUCCESS;
    }
}
