<?php

namespace App\Http\Controllers;

use App\Services\ControllerServices\MarketNewsService\MarketNewsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private MarketNewsService $marketNewsService;

    public function __construct(MarketNewsService $marketNewsService)
    {
        $this->marketNewsService = $marketNewsService;
    }

    public function index(): View
    {

        return view('index');
    }

    public function home(): View
    {
        $newsCategory = 'general';
        $marketNews = $this->marketNewsService->handle($newsCategory);

        return view('marketNews', ['news' => $marketNews]);
    }
}
