<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class ClientRequest extends FormRequest

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
            'name'             => 'required',
            'cpf'              => 'required|unique:clients,cpf',
            'address'          => 'required',
            'city'             => 'required',
            'state'            => 'required',
            'phone'            => 'required',
            'email'            => 'required|email',
        ];
    }


    public function messages()
    {
        return [
            'name.required'            => 'Preencha o campo nome',
            'cpf.required'             => 'Preencha o campo CPF',
            'cpf.unique'               => 'CPF já cadastrado',
            'address.required'         => 'Preencha o campo endereço',
            'city.required'            => 'Preencha o campo cidade',
            'state.required'           => 'Preencha o campo estado',
            'phone.required'           => 'Preencha o campo telefone',
            'email.required'           => 'Preencha o campo email',
            'email.email'              => 'Preencha um email válido',
            ];
    }

    protected function validationData()
    {
        $request = parent::validationData();

        $request['cpf'] = (isset($request['cpf']) ? $this->CPF($request['cpf']) : '');
        return $request;
    }

    protected function CPF($str){
        return preg_replace("/[^0-9]/", "", $str);
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}