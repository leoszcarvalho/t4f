<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;


class CheckoutRequest extends FormRequest

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
            'client_id'           => 'required|exists:clients,id',
            'card_number'         => ['required', new CardNumber()],
            'expiration_year'     => ['required', new CardExpirationYear($this->get('expiration_month'))],
            'expiration_month'    => ['required', new CardExpirationMonth($this->get('expiration_year'))],
            'cvc'                 => ['required', new CardCvc($this->get('card_number'))],
            'token'               => 'required|exists:carts,token',
        ];
    }


    public function messages()
    {
        return [
            'client_id.required'         => 'Informe a identifação do cliente',
            'client_id.exists'           => 'Cliente não encontrado',
            'card_number.required'       => 'Informe o código do cartão',
            'expiration_year.required'   => 'Informe o ano de expiração do cartão',
            'expiration_month.required'  => 'Informe o mês de expiração do cartão',
            'cvc.required'               => 'Informe o códigdo de segurança',
            'token.required'             => 'Informe o token',
            'token.exists'               => 'Token inválido',


        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}