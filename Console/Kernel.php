<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\funding;
use App\people;
use App\districts;
use App\enrollment;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {



$schedule->call(function () {
            


//txt reading


$directory_active="public/active.txt";
$active=file_get_contents($directory_active);
$active_files=explode(',',$active);



// if(count())


if(count($active_files)>2){

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












//payments
if(date('d')==25){

$available=funding::find(date('m'));
if($available->amount>2000000){



$district=districts::orderby('personnel','desc')->first();
//return $district;
$highpeople=people::where('district',$district->name)->get();
foreach ($highpeople as $highpeople) {
    if($highpeople->role==3){
    $highpeople->role=6;
    $highpeople->save();
    } 


    if($highpeople->role==2){
$highpeople->role=5;
    $highpeople->save();
}
        
}


$agent_no=people::where('role',3)->count();
$agenthead_no=people::where('role',2)->count();
$highagenthead_no=people::where('role',5)->count();
$highagent_no=people::where('role',6)->count();
  
$distributable=$available->amount-2000000;
$agent=((1/2) + ((7/4)*$agenthead_no) + (1*$agent_no) + (2*$highagent_no) + ((2*7/4)*$highagenthead_no));
$agent_salary=$distributable/$agent;
$administrator_salary=(1/2)*$agent_salary;
$agenthead_salary=(7/4)*$agent_salary;
$highagent_salary=(2)*$agent_salary;
$highagenthead_salary=(2*7/4)*$agent_salary;
//return $highagenthead_salary;


$pay=people::all();
foreach ($pay as $pay) {


    $one=$administrator_salary;
    $two=$agenthead_salary;
    $three=$agent_salary;
    $four=$highagenthead_salary;
    $five=$highagent_salary;

    if($pay->role==1){
        $pay->salary=$one;
        $pay->save();
    }
      if($pay->role==2){
        $pay->salary=$two;
        $pay->save();
    }
      if($pay->role==3){
        $pay->salary=$three;
        $pay->save();
    }
      if($pay->role==5){
        $pay->salary=$four;
        $pay->role=2;
        $pay->save();
    }
      if($pay->role==6){
        $pay->salary=$five;
        $pay->role=3;
        $pay->save();
    }
}

$available->amount=2000000;
$available->save();



}

}



//enrollment chart



        })->everyMinute();

































        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
