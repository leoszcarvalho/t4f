<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class EventRequest extends FormRequest

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
            'title'             => 'required',
            'description'       => 'required',
            'eventdate'         => 'required|after:today|date_format:d/m/Y',
            'location'          => 'required',
            'state'             => 'required',
            'image'             => 'image|mimes:jpg,jpeg,png,gif'
        ];
    }


    public function messages()
    {
        return [
            'title.required'            => 'Preencha o campo título',
            'description.required'      => 'Preencha o campo descriçãp',
            'eventdate.required'        => 'Preencha a data do evento',
            'eventdate.date'            => 'Preencha data válida',
            'eventdate.after'           => 'Data do evento inválida',
            'eventdate.date_format'     => 'Formato de data inválido, insira uma data válida dia/mes/ano',
            'location.required'         => 'Preencha o local do evento',
            'state.required'            => 'Preencha o estado do evento',
            'image.image'               => 'Somente imagens são permitidas',
            'image.mimes'               => 'Somente os formatos: jpg, jpeg, png e gif são permitidos',


        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}