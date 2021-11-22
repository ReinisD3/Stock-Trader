<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositFundsRequest;
use App\Services\UsersControllerServices\DepositService\DepositService;
use App\Services\UsersControllerServices\ProfileService\ProfileService;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UsersController
{

    private DepositService $depositService;
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService,
                                DepositService $depositService
    )
    {

        $this->depositService = $depositService;
        $this->profileService = $profileService;
    }

    public function profile(): View
    {
        $activeInvestments = $this->profileService->handle();
        return view('user.profile', [
            'activeInvestments' => $activeInvestments,
            'user' => auth()->user()
        ]);
    }

    public function deposit(DepositFundsRequest $request): RedirectResponse
    {
        $this->depositService->handle($request);

        return Redirect::route('user.profile');
    }


}
