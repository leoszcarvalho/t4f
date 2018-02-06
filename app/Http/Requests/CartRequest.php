<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class CartRequest extends FormRequest

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
            'ticket_id'           => 'required|exists:tickets,id',
            'client_id'           => 'required|exists:clients,id',
            'event_id'            => 'required|exists:events,id',
            'qtd'                 => 'required|numeric'
        ];
    }


    public function messages()
    {
        return [
            'ticket_id.required'         => 'Informe o ingresso',
            'ticket_id.exists'           => 'Ingresso não existe',
            'client_id.required'         => 'Informe o cliente',
            'client_id.exists'           => 'Cliente não existe',
            'event_id.required'          => 'Informe o Show',
            'event_id.exists'            => 'Show não encontrado',
            'qtd.required'          => 'Informe a quantidade',
            'qtd.numeric'            => 'Informe uma quantidade válida',

        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}