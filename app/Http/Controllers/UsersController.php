<?php

namespace App\Http\Controllers;

use App\Services\UsersControllerServices\DepositService\DepositService;
use App\Services\UsersControllerServices\ShowTradesService\ShowTradesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UsersController extends Controller
{

    private DepositService $depositService;
    private ShowTradesService $showTradesService;

    public function __construct(DepositService $depositService, ShowTradesService $showTradesService)
    {

        $this->depositService = $depositService;
        $this->showTradesService = $showTradesService;
    }
    public function showProfile():View
    {
        return view('user.profile',
            ['user'=>auth()->user()]
        );
    }
    public function deposit(Request $request):RedirectResponse
    {
        $this->depositService->handle($request);

       return Redirect::route('user.profile');
    }
    public function showTrades():View
    {
        $response = $this->showTradesService->handle(auth()->user()->id);

        return view('user.trades',[
            'trades' => $response->getTrades() ,
            'currentPrices' => $response->getCurrentPrices(),
            'currentProfits' => $response->getCurrentProfits()
        ]);
    }
}
