<?php

namespace App\Src;

use Illuminate\Support\Str;
use \PDF;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LoanCalculator
{

    private $price;
    private $initial_contribution_amount;
    private $period;
    private $annual_interest_rate;
    private $monthly_fee;
    private $payment_date;

    private $results = null;

    public function __construct(int $price, int $initial_contribution_amount, int $period, float $annual_interest_rate, float $monthly_fee, Carbon $payment_date)
    {
        $this->price = $price;
        $this->initial_contribution_amount = $initial_contribution_amount;
        $this->period = $period;
        $this->annual_interest_rate = $annual_interest_rate;
        $this->monthly_fee = $monthly_fee;
        $this->payment_date = $payment_date;
    }

    private function calculate() : LoanCalculator
    {
        $items = [];
        $capital = $this->price - $this->initial_contribution_amount;
        $interest = $this->annual_interest_rate / 100;
        $result= $interest / 12 * pow(1 + $interest / 12, $this->period) / (pow(1 + $interest / 12, $this->period) - 1) * $capital;
        $totalUnpaid = $result * $this->period + $this->monthly_fee * $this->period;
        $monthProc = $this->annual_interest_rate / 12;
        $totalLeftCapital = $capital;

        $monthValue = $capital / $this->period;

        for ($i = 1; $i <= $this->period; $i++)
        {
            $date = (clone $this->payment_date)->addMonths($i)->format('Y-m-d');
            $paymentAmount = $result + $this->monthly_fee;
            $amountOfInterest = $totalLeftCapital * $monthProc / 100;
            $items[] = [
                'date' => $date,
                'remaining_unpaid_amount' => $this->format($totalUnpaid),
                'loan_repayment_amount' => $this->format($paymentAmount - $this->monthly_fee - $amountOfInterest),
                'amount_of_interest' => $this->format($amountOfInterest),
                'contract_fee' => $this->format($this->monthly_fee),
                'payment_amount' => $this->format($paymentAmount)
            ];
            $totalUnpaid -= $paymentAmount;
            $totalLeftCapital -= $monthValue;
        }

        $this->results = [
            'price' => $this->format($this->price),
            'initial_contribution_amount' => $this->format($this->initial_contribution_amount),
            'period' => $this->period,
            'annual_interest_rate' => $this->annual_interest_rate,
            'monthly_fee' => $this->format($this->monthly_fee),
            'payment_date' => $this->payment_date->format("Y-m-d"),
            'items' => $items
        ];

        return $this;
    }

    /**
     * @param string $type
     * @return \Illuminate\Contracts\View\View|JsonResponse|\Illuminate\Http\Response|null
     */
    public function preview(string $type)
    {
        $rv = null;

        if (!$this->results) {
            $this->calculate();
        }

        switch ($type) {
            case LoanTypes::TYPE_PDF;
                $rv = (PDF::loadView('home.loan', $this->results))
                    ->download(Str::snake(date("Y-m-d-").time()).'.pdf');
            break;
            case LoanTypes::TYPE_HTML;
                $rv = View::make('home.loan', $this->results);
            break;
            case LoanTypes::TYPE_JSON;
                $rv = new JsonResponse($this->results);
            break;
            default:
                throw new NotFoundHttpException(trans('error.page_not_found'));
                break;
        }

        return $rv;
    }

    private function format($paymentAmount)
    {
        return number_format($paymentAmount, 2, '.', ' ');
    }

}
