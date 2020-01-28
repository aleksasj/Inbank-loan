<?php

namespace App\Requests;

use App\Src\Rv;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected $redirectAction = 'HomeController@index';

    protected function failedValidation(Validator $validator) {
        if ($this->isXmlHttpRequest() || $this->wantsJson()) {
            throw new HttpResponseException(response()->json(new Rv(false, $validator->errors()), 422));
        } else {
            parent::failedValidation($validator);
        }
    }
}
