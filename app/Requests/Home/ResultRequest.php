<?php

namespace App\Requests\Home;

use App\Requests\BaseRequest;
use App\Src\LoanTypes;
use Carbon\Carbon;

class ResultRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'price' => ['required', 'integer', 'min:100', 'max:15000'],
            'initial_contribution_amount' => ['lt:price', 'required', 'integer', 'min:0', 'max:15000'],
            'period' => ['required', 'integer', 'min:3', 'max:48'],
            'annual_interest_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'monthly_fee' => ['required', 'numeric', 'min:0'],
            'payment_date' => ['required', 'date'],
            'preview_type' => ['required', 'in:'.implode(',', LoanTypes::$availableTypes)]
        ];
    }

    public function getPrice() : int
    {
        return (int) $this->get('price');
    }

    public function getInitialContributionAmount() : int
    {
        return (int) $this->get('initial_contribution_amount');
    }

    public function getPeriod() : int
    {
        return (int) $this->get('period');
    }

    public function getAnnualInterestRate() : float
    {
        return (float) $this->get('annual_interest_rate', 0);
    }

    public function getMonthlyFee() : float
    {
        return (float) $this->get('monthly_fee', 0);
    }

    public function getPaymentDate() : Carbon
    {
        return Carbon::parse($this->get('payment_date'));
    }

    public function getPreviewType() : string
    {
        return $this->get('preview_type');
    }
}
