<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Model\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $model = '';

    public function __construct()
    {
        $this->model = new Client();
    }


    public function index(){

        $event    = $this->model->all();

        if(!$event) {
            return response()->json([
                'data'   => '',
                'message'   => 'Registro não encontrado.',
            ], 404);
        }

        return response()->json(['data' => $event, 'message'=>'']);

    }

    public function store(ClientRequest $request ){

        $event   = $this->model->create([
            'name'             => $request->name,
            'cpf'              => $request->cpf,
            'address'          => $request->address,
            'city'             => $request->city,
            'state'            => $request->state,
            'phone'            => $request->phone,
            'email'            => $request->email
        ]);



        return response()->json(['data' => $event, 'message'=>'Cadastrado com sucesso!']);

    }
}
