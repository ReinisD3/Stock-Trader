<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Repositories\FinhubRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StockDataController extends Controller
{
    private $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('stocks.index');
    }

    public function search(Request $request)
    {
        $companyName = strtolower($request['company']);
        $cachedKey = 'companies.search.'.$companyName;

        if(cache()->has($cachedKey)){
            return view('stocks.index', ['companies' => cache()->get($cachedKey)]);
        }
        $companies = $this->repository->searchCompanies($companyName);



        cache()->put($cachedKey,$companies);

        return view('stocks.index', ['companies' => $companies]);
    }

    public function info(string $companySymbol)
    {

        $cachedKey = 'company.info.'.$companySymbol;

        if(cache()->has($cachedKey)){
            return view('stocks.companyInfo', [
                'company'=> cache()->get($cachedKey),
                'userBalance' =>(User::find(Auth::id()))->balance
            ]);
        }
        $company = $this->repository->getCompanyInfo($companySymbol);

        cache()->put($cachedKey,$company);

        return view('stocks.companyInfo',[
            'company'=> $company ,
            'userBalance' =>(User::find(Auth::id()))->balance
        ]);

    }
}
