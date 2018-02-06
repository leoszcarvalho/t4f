<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Model\Ordersdetails;
use App\Model\Ticket;

class TicketController extends Controller
{
    protected $model = '';

    public function __construct()
    {
        $this->model = new Ticket();
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

    public function store(TicketRequest $request ){

        $event   = $this->model->with('Ticket')->create([
            'price'             =>  $request->price,
            'tax'               =>  $request->tax,
            'event_id'          =>  $request->event_id,
        ]);

        return response()->json(['data' => $event, 'message'=>'Cadastrado com sucesso!']);
    }


    public function valid($code){

        $event    = Ordersdetails::with('Ticket', 'Event', 'Checkout')->where('code', '=', $code)->first();

        if(!$event) {
            return response()->json([
                'data'   => '',
                'message'   => 'Código inválido.',
            ], 404);
        }
        return response()->json(['data' => $event, 'message'=>'']);

    }

}
