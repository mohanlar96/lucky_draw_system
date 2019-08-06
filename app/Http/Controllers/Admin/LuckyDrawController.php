<?php

namespace App\Http\Controllers\Admin;

use App\PrizeType;
use App\UserTicket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LuckyDrawController extends Controller
{
    public function index()
    {
       return view('admin/luckydraw')->with('prizes', PrizeType::all());
    }


    private function listOfNumbersAllowToInput(){
        //Purpose : Check winner from db Then not allow admin to input number relative with winners
        
        //Logic : Select user_ticket.number Where prize_type.id != user_ticket.user_id and prize_type.wining_number != null




    }

    private function listOfNumbersAllowToInputForGrandPrize(){
        // list Members with most number of winning number
            // Additional Logic : count of (user_ticket.user_id) is largest .
        //Logic : Select user_ticket.number Where prize_type.id != user_ticket.user_id and prize_type.wining_number != null and


        //return  their numbers in array.
    }

    private function randomValueFromArrayList($arr){

       $random_key= array_rand($arr)[0];


       return $arr[$random_key];


       //return a random number


    }


    public function create(Request $request)
    {
        $validator1=Validator::make($request->all(),[
                'prize'=>['required','integer'],
                'generate'=>['required','integer'],
        ]);

        if($validator1->fails()){
            return back()->withInput()->withErrors($validator1);
        }

        if(!$request->get('generate')){  // if auto generate is " NO "


            $validator=Validator::make($request->all(),[
                'number' => ['required','unique:user_tickets,number','numeric','digits:4'],
            ]);
            $validator->after(function ($validator) use ($request) {
                $number=$request->get('number');
                $prize=$request->get('prize');

                //check weather this number is already picked or not by any users
                if (UserTicket::where('number',$number)->first()==null)
                    $validator->errors()->add('number', 'This lucky draw number is not picked by anyone');


                // check weather this number is already in database or already selected by admin
                if (PrizeType::where('winning_number',$number)->where('id','<>',$prize)->first()!= null)
                    $validator->errors()->add('number', 'This lucky draw number was already won');


                // Admin can't input the number if this number is relative with winners' others number
                // Ref : Each user can only win one prize.
                if(!in_array($number,$this->listOfNumbersAllowToInput()))
                    $validator->errors()->add('number', 'One user can only win one prize, this winning number already have a winner');


                //if this number is for first prize , id=7 is for first prize (Grand Prize )
                //Ref : First Prize is for only Members with most number of winning number
                if( ($prize == 7) && (!in_array($number,$this->listOfNumbersAllowToInputForGrandPrize())) )
                    $validator->errors()->add('number', 'First Prize is for only Members with most number of winning number');


            });
            if($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }
            //else number is validate and ready to update in database ,
            PrizeType::where('id',$request->get('prize'))->update(['winning_number'=>$request->get('winning_number')]);



        }else{
            // if auto generate is " YES "

            //if this is for Grand
            $validated_number_arr_list=($request->get('prize') == 7)?$this->listOfNumbersAllowToInputForGrandPrize():$this->listOfNumbersAllowToInput();

            $randomNumber=$this->randomValueFromArrayList($validated_number_arr_list);

            //optimize memory usage
            unset($validated_number_arr_list);


            PrizeType::where('id',$request->get('prize'))->update(['winning_number'=>$randomNumber]);



        }









    }

    public function reset()
    {
        PrizeType::where('winning_number','<>','null')->update(['winning_number'=>'null']);

        return back()->with('status','Reset Successfully');
    }
}
