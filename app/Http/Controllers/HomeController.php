<?php

namespace App\Http\Controllers;

use App\Requests\Home\ResultRequest;
use App\Src\LoanCalculator;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    public function index()
    {
        return View::make('home.index');
    }

    public function result(ResultRequest $request)
    {
        $loanCalculator = new LoanCalculator(
            $request->getPrice(),
            $request->getInitialContributionAmount(),
            $request->getPeriod(),
            $request->getAnnualInterestRate(),
            $request->getMonthlyFee(),
            $request->getPaymentDate()
        );

        return $loanCalculator->preview($request->getPreviewType());
    }
}
