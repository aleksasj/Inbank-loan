@extends('layout')

@section('content')
    <h2>Hey, your report :)</h2>
    <b>{{ trans('field.price') }}</b> {{ $price }} &euro; <br/>
    <b>{{ trans('field.initial_contribution_amount') }}</b> {{ $initial_contribution_amount }} &euro; <br/>
    <b>{{ trans('field.annual_interest_rate') }}</b> {{ $annual_interest_rate }}% <br/>
    <b>{{ trans('field.monthly_fee') }}</b> {{ $monthly_fee }} <br/>
    <b>{{ trans('field.period') }}</b> {{ $period }} <br/>
    <b>{{ trans('field.payment_date') }}</b> {{ $payment_date }}  <br/>
    <br/>
    <br/>
    <table width="100%" class="table">
        <thead>
            <tr>
                <th>{{ trans('html.date') }}</th>
                <th>{{ trans('html.remaining_unpaid_amount') }}</th>
                <th>{{ trans('html.loan_repayment_amount') }}</th>
                <th>{{ trans('html.amount_of_interest') }}</th>
                <th>{{ trans('html.contract_fee') }}</th>
                <th>{{ trans('html.payment_amount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td align="center">{{ $item['date'] }}</td>
                    <td align="right">{{ $item['remaining_unpaid_amount'] }} &euro;</td>
                    <td align="right">{{ $item['loan_repayment_amount'] }} &euro;</td>
                    <td align="right">{{ $item['amount_of_interest'] }} &euro;</td>
                    <td align="right">{{ $item['contract_fee'] }} &euro;</td>
                    <td align="right">{{ $item['payment_amount'] }} &euro;</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
