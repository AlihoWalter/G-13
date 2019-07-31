<?php

namespace App\Http\Controllers;
use App\districts;
use App\people;
use App\enrollment;

use App\funding;
use App\donations;
use DB;
use Illuminate\Http\Request;

class pagescontroller extends Controller
{
    //
    public function login(){
        return view('auth.login');
    }
    public function members(Request $Request){






$directory_active="public/active.txt";
$active=file_get_contents($directory_active);
$active_files=explode(',',$active);


// if(count())

if(count($active_files)!=1)
{
 $active_agents = fopen("public/active.txt", "r");
while(!feof($active_agents)) {
  $check=explode(',',fgets($active_agents));

$sign=0;

    

//$directory="public/".$check[0];


$active_agents = fopen("public/".$check[0], "r");
while(!feof($active_agents)) {
  $confirm=explode(',',fgets($active_agents));
 
 


if(count($confirm)<2){

$response = fopen(trim("public/".$check[2]), "w");
$txt="Invalid or empty signature";
    fwrite($response,$txt);
fclose($response);

}
else{

$person=DB::table('people')->where('identity',$confirm[0])->pluck('signature');

if (count($person)==0){


$response = fopen(trim("public/".$check[2]),"w");
$txt="Agent doesnt exist";
    fwrite($response,$txt);
fclose($response);


}
else{
// echo $confirm[1];
// echo "<br>";
// return $person[0];
    if(strncmp($confirm[1],$person[0],15)==0){


  $myfile = fopen(trim("public/".$check[1]), "r");
while(!feof($myfile)) {
  $file=explode(',',fgets($myfile));

//    print_r($file[0]);
// }
$no=rand(100,10000);
// $file[0];
$dash="_";
$makeArray=array($file[0],$dash,$no);
$identity=implode($makeArray);
// $file[1];


$people = new people;
$people->name=$file[1];
   $people->district=$file[0];
        $people->sex=$file[3];

        $people->identity=$identity;
        $people->recommender_id=$file[4];
        $people->date=$file[2];
        
        $people->signature="101910910101";
        $people->role=4;
        $people->salary=0;
        $people->save();

//$districts = new districts;
$districts=districts::where('name',$file[0])->pluck('id');
$district=districts::find($districts[0]);

$now=$district->personnel;
$district->personnel=$now+1;
$district->save();


$enrollment=enrollment::find(date('m'));
$fornow=$enrollment->number;
$enrollment->number=$fornow+1;
$enrollment->save();




}


fclose($myfile);
//unlink("publicdata.txt");
$mfile = fopen(trim("public/".$check[1]), "w");
$ile = fopen(trim("public/".$check[0]), "w");
// unlink("sign.txt");
fclose($mfile);
fclose($ile);
$response = fopen(trim("public/".$check[2]), "w");

$txt="The file was saved succesfully";
    fwrite($response,$txt);
fclose($response);

}

else{

$response = fopen(trim("public/".$check[2]), "w");
$txt="File not saved";
    fwrite($response,$txt);
fclose($response);


}


}

}
}

}
$checked = fopen("public/active.txt", "w");
fclose($checked);

}














































$members=people::where('role',4)->get();
$membersCount=count($members);
        return view('members',compact('membersCount'));
       
    }
    public function agents(){
        $people=people::where('recommender_id','administrator')->orderby('created_at','asc')->get();
        $districts=districts::select('name')->orderby('name','asc')->pluck('name','name');
       /// return $districts;
        return view('agents',compact('people','districts'));
        //return view('agents');
    }
    public function payments(){



$district=districts::where('name','kampala')->pluck('personnel');

return view('payments');
    }
    public function upgrades(){
        $people=[];

       $upgrade=DB::table('people')
                    ->select('recommender_id',DB::raw('count(*) as total'))
                    ->where('role',4)
                    ->groupBy('recommender_id')
                    ->get();
                    //echo $upgrade;
                foreach ($upgrade as $agent) {
                    if($agent->total>0){
                    $person=people::where('identity',$agent->recommender_id)->get();
                    foreach ($person as $newagent) {
                     if($newagent->role=='4'){
                     array_push($people, $newagent);
                    }
                }
                    }
    }


       return view('upgrades',compact('people'));
    }
    public function districts(){
     $districts=districts::all();
     $people=people::all();


        return view('districts',compact('people','districts'));
    }
    public function funding(){
        return view('funding');
    }
    public function donations(){
        return view('donations');
    }
    public function enrollment(){
        return view('enrollment');
    }


public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'amount'=>'required'
        
        
            
        ]);

$donor= new donations;
   $donor->name=$request->input('name');
   $donor->amount=$request->input('amount');
        
        
        
        $donor->save();

$date_now=date('m');
$funding=funding::find($date_now);
$funding->amount=$request->input('amount')+$funding->amount;
$funding->save();
        return redirect('/payments')->with('success','Donation registered');




        //
    }



}
