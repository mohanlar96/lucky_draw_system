<?php

namespace App\Http\Controllers\Admin;

use App\PrizeType;
use App\User;
use App\UserTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LuckyDrawController extends Controller
{
    public function index()
    {
       return view('admin/luckydraw')->with('prizes', PrizeType::all());
    }

    private $validator;

    public function listOfNumberAllowToWinPrize(){
        // Ref : Each user can only win one prize.


        $AllowNumber=UserTicket::select('number')->get();

        $numberList=array();

        foreach ($AllowNumber as $arr)
            array_push($numberList,$arr->number);

        unset($AllowNumber); //clear memory

         $arr=array_diff($numberList,$this->listOfNumbersNotAllowToWinPrize());


         return $arr;

//        $random_key= array_rand($arr);
//
//        return $arr[$random_key];



    }
    public function listOfNumbersNotAllowToWinPrize(){
        // Ref : Each user can only win one prize ( in alternative )
        // SQL 1) Get List of Winning_number from prize_type table .
        // SQL 2) Get List of id from user_ticket table join with SQL 1
        // SQL 3) Then Fetch As Not allow
        // combined LOGIC SQ1 1,2,3 and OUTPUT  AS $notAllowNumber

        $notAllowNumber=DB::select("
        SELECT DISTINCT
            user_tickets.number
        FROM
            (
            SELECT
                user_tickets.user_id
            FROM
                user_tickets
            JOIN(
                SELECT
                    p.winning_number
                FROM
                    prize_types AS p
                WHERE
                    p.winning_number IS NOT NULL
            ) AS N
        ON
            user_tickets.number = N.winning_number
        ) AS Users
        JOIN user_tickets ON user_tickets.user_id = Users.user_id
        
        ");
        $numberList=array();

        foreach ($notAllowNumber as $arr)
            array_push($numberList,$arr->number);

        unset($notAllowNumber);// clear memory

        return $numberList;
    }

    public function listOfNumbersAllowToInputForGrandPrize(){

        // list Members with most number of winning number
        // SQL 1) SQL Logic : count of maximum tickets which can have by users .
        // SQL 2) Then  Select users who have most number of winning tickets (number)
        // SQL 3) Then fetch numbers List
        // combined LOGIC SQ1 1,2,3 and OUTPUT  AS $numbersListForGrandPrize

          $numbersListForGrandPrize=  DB::select("
            SELECT
                user_tickets.number
            FROM
                (
                SELECT
                    Y.user_id
                FROM
                    (
                    SELECT
                        COUNT(user_id) AS `count`,
                        user_id
                    FROM
                        user_tickets
                    GROUP BY
                        user_id
                ) AS Y
            WHERE
                Y.count =(
                SELECT
                    MAX(X.count) AS `max_count`
                FROM
                    (
                    SELECT
                        user_id,
                        COUNT(user_id) AS `count`
                    FROM
                        user_tickets
                    GROUP BY
                        user_id
                ) AS X
            )
            ) AS L
            JOIN user_tickets ON L.user_id = user_tickets.user_id;
          ");

          $numberList=array();

          foreach ($numbersListForGrandPrize as $arr)
              array_push($numberList,$arr->number);


          //convert into simple one demissional array

          unset($numbersListForGrandPrize); // clear memory


        // @method listOfNumbersAllowToWinPrize() Ref : Each user can only win one prize.
        return array_diff($numberList,$this->listOfNumbersNotAllowToWinPrize());

    }

    private function randomValueFromArrayList($arr){

       $random_key= array_rand($arr);

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
                'winning_number' => ['required','numeric','digits:4'],
            ]);

            $validator->after(function ($validator) use ($request) {
                $number=$request->get('winning_number');
                $prize=$request->get('prize');

                //check weather this number is already picked or not by any users
                if (UserTicket::where('number',$number)->first()==null)
                    $validator->errors()->add('winning_number', 'This lucky draw number is not took by any Member');

                // check weather this number is already in database or already selected by admin
                if (PrizeType::where('winning_number',$number)->first()!= null)
                    $validator->errors()->add('winning_number', 'This lucky draw number was already won , one number is only for one Prize Type');

                // Admin can't input the number if this number is relative with winners' others number
                // Ref : Each user can only win one prize.
                if(in_array($number,$this->listOfNumbersNotAllowToWinPrize()))
                    $validator->errors()->add("winning_number", "One user can only win one prize, this winning number' Member is already a winner");


                //if this number is for first prize , id=7 is for first prize (Grand Prize )
                //Ref : First Prize is for only Members with most number of winning number
                if( ($prize == 7) && (!in_array($number,$this->listOfNumbersAllowToInputForGrandPrize())) )
                    $validator->errors()->add('winning_number', 'First Prize is for only Members with most number of winning number');
            });


            if($validator->fails()){
//                dd($validator);
                return back()->withInput()->withErrors($validator);
            }
            //else number is validate and ready to update in database ,
            PrizeType::where('id',$request->get('prize'))->update(['winning_number'=>$request->get('winning_number'),'admin_id'=>auth()->user()->id]);

        }else{
            // if auto generate is " YES "

                //if this is for Grand
                // id 7 is grand prize id
                if ($request->get('prize') == 7) {
                    $validated_number_arr_list = $this->listOfNumbersAllowToInputForGrandPrize();

                    //if all of the user are win and nobody left for grand prize.
                    if (count($validated_number_arr_list) >= 1)
                        $randomNumber = $this->randomValueFromArrayList($validated_number_arr_list);
                    else
                        return back()->with('status', 'There is no Member with most number of winning number left to win this prize ,One prize is for only one member')->with('suggest',"System Suggestion : Drawing firstly for Grand Prize then other prize is a good orders ");



                } else { // if not grand (first) prize)

                    $validated_number_arr_list = $this->listOfNumberAllowToWinPrize();
                    if (count($validated_number_arr_list) >= 1)
                        $randomNumber = $this->randomValueFromArrayList($validated_number_arr_list);
                    else
                        return back()->with('status', 'Each user can only win one prize and No Member left to win this prize ');
                }

                  unset($validated_number_arr_list);

                PrizeType::where('id',$request->get('prize'))->update(['winning_number'=>$randomNumber,'admin_id'=>auth()->user()->id]);



        }
        return redirect('/')->with('status',"Successfully Updated the ".PrizeType::where('id',$request->get('prize'))->first()->name);

    }

    public function reset()
    {
        PrizeType::whereNotNull('winning_number')->update(['winning_number'=>null,'admin_id'=>null]);

        return back()->with('status','Reset Successfully');
    }
}
