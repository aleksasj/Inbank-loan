@extends('layout')

@section('content')

<form method="post" action="{{ action('HomeController@result') }}">
    @csrf
    @include('form.field', ['type' => 'number',  'name' => 'price', 'value' => '100'])
    @include('form.field', ['type' => 'number',  'name' => 'initial_contribution_amount', 'value' => '0'])
    @include('form.field', ['type' => 'number',  'name' => 'period', 'value' => '3'])
    @include('form.field', ['type' => 'text',  'name' => 'annual_interest_rate', 'value' => '5.550'])
    @include('form.field', ['type' => 'number',  'name' => 'monthly_fee', 'value' => '15'])
    @include('form.field', ['type' => 'date',  'name' => 'payment_date', 'value' => date('Y-m-d')])
    @include('form.choice', ['type' => 'number', 'options' => \App\Src\LoanTypes::$availableTypes,  'name' => 'preview_type', 'value' => 'pdf'])
    <div class="form-group">
        <button type="submit">{{ trans('field.submit') }}</button>
    </div>
</form>
@endsection
