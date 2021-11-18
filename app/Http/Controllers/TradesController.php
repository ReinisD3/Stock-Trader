<?php

namespace App\Http\Controllers;


use App\Services\TradesControllerServices\BuyService\BuyService;
use Illuminate\Http\RedirectResponse;

class TradesController extends Controller
{
    private BuyService $buyService;

    public function __construct(BuyService $buyService)
    {
        $this->buyService = $buyService;
    }

    public function buy(string $companySymbol):RedirectResponse
    {
        $this->buyService->handle($companySymbol);

        return redirect(route('user.trades'));
    }

    public function sell()
    {
        var_dump('PARDODAM');
    }

}
