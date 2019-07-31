<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\people;
use App\districts;
class agentscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

$this->validate($request,[
            'name'=>'required',
            'district'=>'required',
            'sex'=>'required',
            
        ]);
$no=rand(1000,100000);
// $file[0];
$dash="_";
$makeArray=array($request->input('district'),$dash,$no);
$identity=implode($makeArray);


$district=districts::where('personnel','<',1)->pluck('id');
if(count($district)>0){
$anotherone=districts::find($district[0]);
$value=$anotherone->name;
$role=2;
//$latervalue=districts::find($latestvalue[0]);
 $another=$anotherone->personnel;
 $anotherone->personnel=$another+1;
 $anotherone->save();

}
else{


$districts=districts::where('name',$request->input('district'))->pluck('id');


$anotherone=districts::find($districts[0]);
$value=$anotherone->name;

//$latervalue=districts::find($latestvalue[0]);
 $another=$anotherone->personnel;
 $anotherone->personnel=$another+1;
 $anotherone->save();







$value=$request->input('district');
$role=3;

}


$people = new people;
               
    $people->name=$request->input('name');
   $people->district=$value;
        $people->sex=$request->input('sex');
        $people->identity=$identity;
 $data=$identity.'data.txt';
$dat=$identity.'sign.txt';
$da=$identity.'status.txt';

       $file=fopen($data,'w');
       $fil=fopen($dat,'w');
       $fi=fopen($da,'w');
fclose($file);
fclose($fil);
fclose($fi);


        $people->recommender_id="administrator";
        $people->date=date("y-m-d");
        
        $people->signature="111100100100111";
        $people->role=$role;
        $people->salary=0;

        
        
        $people->save();
        return redirect('/agents')->with('success','Agent added');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upgrade(Request $request)
    {
        //

        $empty=districts::where('personnel','<',1)->pluck('id');
        if(count($empty)>0){
    $data=$request->input('id').'data.txt';
     $dat=$request->input('id').'sign.txt';
      $da=$request->input('id').'status.txt';


         $file=fopen($data,'w');
       $fil=fopen($dat,'w');
       $fi=fopen($da,'w');
fclose($file);
fclose($fil);
fclose($fi);




//return $latestvalue->name;
            $person=people::where('identity',$request->input('id'))->pluck('id');
            //return $person[0];
            $upgrade=people::find($person[0]);
            $upgrade->role=2;


            // increment personnel no
            $district=districts::find($empty[0]);

            $now=$district->personnel;
            
            $district->personnel=$now+1;
            $district->save();
            

//decrement personnel no

$value=people::where('identity',$request->input('id'))->pluck('id');
$newvalue=people::find($value[0]);
$newvalue->district;
$latestvalue=districts::where('name',$newvalue->district)->pluck('id');

$latervalue=districts::find($latestvalue[0]);
 $anotherone=$latervalue->personnel;
 $latervalue->personnel=$anotherone-1;
 $latervalue->save();









            $upgrade->district=$district->name;
            $upgrade->save();




            return redirect('/upgrades')->with('success','Member upgraded');
         

        }
        else{

           return redirect('/upgrades')->with('error','All districts are full now Please try again later');

        }

    }
}
