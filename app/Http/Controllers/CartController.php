<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Model\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $model = '';

    public function __construct()
    {
        $this->model = new Cart();
    }


    public function show($token){

        $cart    = $this->model->with('Event','Client', 'Ticket')->where('token','=',$token)->get();

        if(!$cart) {
            return response()->json([
                'data'   => '',
                'message'   => 'Registro não encontrado.',
            ], 404);
        }

        return response()->json(['data' => $cart, 'message'=>'']);

    }

    public function store(CartRequest $request ){

        //Validate
        if(!$request->token){
            $request->token = sha1(time());
        }

        $cart   = $this->model->where('token', '=', $request->token)->orderBy('created_at', 'desc')->first();

        if($cart) {
            if ($cart->event_id != $request->event_id && $cart->client_id == $request->client_id) {
                return response()->json(['data' => 'Somente adicionar tickets do mesmo show no seu carrinho.', 'message' => '']);
            }
        }


        $event   = $this->model->create([
            'token'           =>  $request->token,
            'ticket_id'         =>  $request->ticket_id,
            'client_id'         =>  $request->client_id,
            'event_id'          =>  $request->event_id,
            'qtd'               => $request->qtd
        ]);



        return response()->json(['data' => $event, 'message'=>'Cadastrado com sucesso!']);

    }
}
