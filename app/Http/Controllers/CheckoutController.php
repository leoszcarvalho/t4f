<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Model\Cart;
use App\Model\Checkout;
use App\Model\Ordersdetails;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $model = '';

    public function __construct()
    {
        $this->model = new Checkout();
    }



    public function store(CheckoutRequest $request){

        //Gateway
        $code       = sha1(time());

        $order   = $this->model->create([
            'client_id'          =>  $request->client_id,
            'date'               =>  date('Y-m-d'),
            'authorization_code' => $code,
        ]);

        $products   = Cart::where('token','=', $request->token)->get();

        foreach ($products as $product){
            $produts    = Ordersdetails::create([
               'order_id'       => $order->id,
               'event_id'       => $product->event_id,
               'ticket_id'      => $product->ticket_id,
               'total'          => ($product->Ticket->tax + $product->Ticket->price),
               'code'           =>  rand(100000,999999),
            ]);
        }


        return response()->json(['data' => $order, 'message'=>'Cadastrado com sucesso!']);

    }
}
