<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Http\Requests\EventRequest;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    protected $model = '';

    public function __construct()
    {
        $this->model = new Event();
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

    public function store(EventRequest $request ){

        $path   = public_path('dbimages');

        if (isset($request->image)) {
            $thumb = 'img_'. time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move($path, $thumb);
        }

        $data = implode("-", array_reverse(explode("/", trim($request->eventdate))));

        $date = date('Y-m-d', strtotime($data));

        $event   = $this->model->create([
            'title'             =>  $request->title,
            'description'       =>  $request->description,
            'eventdate'         =>  $date,
            'location'          =>  $request->location,
            'state'             =>  $request->state,
            'image'             => (isset($request->image) ?  $path.'/'.$thumb : 'nao'),
        ]);



        return response()->json(['data' => $event, 'message'=>'Cadastrado com sucesso!']);

    }

    public function search(Request $request){

        $event   = $this->model->query();

        if (isset($request->title)) {
            $event->where('title', 'like', '%' . $request->title . '%');
        }

        if (isset($request->eventdate)) {
            $event->where('eventdate', 'like', '%' . $request->eventdate . '%');
        }

        if (isset($request->description)) {
            $event->where('description', 'like', '%' . $request->description . '%');
        }

        if (isset($request->location)) {
            $event->where('location', 'like', '%' . $request->location . '%');
        }

        if (isset($request->state)) {
            $event->where('state', 'like', '%' . $request->state . '%');
        }

        $response  = $event->get();

        return response()->json(['data' => $response, 'message'=>'']);


    }

}
