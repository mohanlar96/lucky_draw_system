<?php

namespace App\Http\Controllers;

use App\PrizeType;
use App\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home')->with('tickets',Auth::user()->tickets);
    }

    public function draw(Request $request)
    {
        $validater=Validator::make($request->all(),[
             'user_id'=> ['required','numeric'],
             'number' => ['required','unique:user_tickets,number','numeric','digits:4'],
        ]);

        if($validater->fails()){
            return back()->withInput()->withErrors($validater);
        }else{
            UserTicket::create(['number'=>$request['number'], 'user_id'=>$request['user_id']]);
            return back()->with('status','Successfully Draw No');

        }


    }




}
