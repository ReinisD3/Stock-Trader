<?php

namespace App\Http\Controllers;


use App\Http\Requests\BuyCompanyStockRequest;
use App\Http\Requests\SellCompanyStockRequest;
use App\Http\Requests\ShowTradesRequest;
use App\Http\Requests\ShowTradeTransactionsRequest;
use App\Models\Trade\Trade;
use App\Services\TradesControllerServices\BuyService\BuyService;
use App\Services\TradesControllerServices\SellIndexService\SellIndexService;
use App\Services\TradesControllerServices\SellService\SellService;
use App\Services\TradesControllerServices\ShowTradesService\ShowTradesService;
use App\Services\TradesControllerServices\ShowTradeTransactionsService\ShowTradeTransactionsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class TradesController extends Controller
{
    private BuyService $buyService;
    private SellService $sellService;
    private ShowTradesService $showTradesService;
    private SellIndexService $sellIndexService;
    private ShowTradeTransactionsService $showTradeTransactionsService;

    public function __construct(BuyService                   $buyService,
                                SellService                  $sellService,
                                ShowTradesService            $showTradesService,
                                SellIndexService             $sellIndexService,
                                ShowTradeTransactionsService $showTradeTransactionsService
    )
    {
        $this->buyService = $buyService;
        $this->sellService = $sellService;
        $this->showTradesService = $showTradesService;
        $this->sellIndexService = $sellIndexService;
        $this->showTradeTransactionsService = $showTradeTransactionsService;
    }

    public function buy(BuyCompanyStockRequest $request, string $companySymbol): RedirectResponse
    {
        $validated = $request->validated();
        $this->buyService->handle($validated, $companySymbol);

        return redirect(route('user.trades'));
    }

    public function sellIndex(Trade $trade): View
    {
        $response = $this->sellIndexService->handle($trade);

        return view('user.sellStock', [
            'company' => $response->getCompany(),
            'price' => $response->getCurrentPrice(),
            'trade' => $response->getTrade()
        ]);
    }

    public function sell(SellCompanyStockRequest $request, Trade $trade): RedirectResponse
    {
        $this->sellService->handle($request, $trade);

        return redirect()->route('user.history');
    }

    public function showTrades(ShowTradesRequest $request): View
    {

        $response = $this->showTradesService->handle($request, auth()->user()->id);


        return view('user.trades', [
            'trades' => $response->getTrades(),
            'companyList' => $response->getCompanyList(),
            'sortDirection' => $response->getSortDirection()
        ]);
    }

    public function showTradeTransactions(ShowTradeTransactionsRequest $request): View
    {
        $response = $this->showTradeTransactionsService->handle($request,auth()->user()->id);


        return view('user.tradesTransactions',
            ['trades' => $response->geTradesTransactions(),
                'companyList' => $response->getCompanyList(),
                'sortDirection' => $response->getSortDirection()]);
    }
}
