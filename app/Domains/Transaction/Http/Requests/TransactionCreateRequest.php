<?php

namespace  App\Domains\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class TransactionCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:0',
            'payee' => 'required|exists:users,id',
            'payer' => 'required|exists:users,id',
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}