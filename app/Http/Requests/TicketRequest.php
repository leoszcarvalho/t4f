<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class TicketRequest extends FormRequest

{
    public function wantsJson()
    {
        return true;
    }


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'tax'             => 'required|numeric|between:0,99.9999999.99',
            'price'           => 'required|numeric|between:0,99.9999999.99',
            'event_id'        => 'required|exists:events,id',
            ];
    }


    public function messages()
    {
        return [
            'tax.required'             => 'Informe o valor de taxa',
            'tax.numeric'              => 'Preencha um valor válido',
            'tax.between'              => 'Preencha um valor válido',
            'price.required'           => 'Informe um preço',
            'price.numeric'            => 'Preencha um valor válido',
            'price.between'            => 'Preencha um valor válido',
            'event_id.required'        => 'Informe o show',
            'event_id.exists'          => 'Código do show inválido.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}