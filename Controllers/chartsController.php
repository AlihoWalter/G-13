<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\User;
use App\enrollment;
use App\funding;
class chartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $enrollment=enrollment::all();
    $count=count($enrollment);

    foreach($enrollment as $enrollment) { 
    $no=$enrollment->number;

    if($enrollment->id==1){
        $new=$enrollment=enrollment::find(2);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();
        
        

    }

    if($enrollment->id==2){
        $new=$enrollment=enrollment::find(3);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==3){
        $new=$enrollment=enrollment::find(4);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==4){
        $new=$enrollment=enrollment::find(5);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
      if($enrollment->id==5){
        $new=$enrollment=enrollment::find(6);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==6){
        $new=$enrollment=enrollment::find(7);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==7){
        $new=$enrollment=enrollment::find(8);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==8){
        $new=$enrollment=enrollment::find(9);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==9){
        $new=$enrollment=enrollment::find(10);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==10){
        $new=$enrollment=enrollment::find(11);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==11){
        $new=$enrollment=enrollment::find(12);
       $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    if($enrollment->id==12){
        $new=$enrollment=enrollment::find(1);
        $enrollment->percentage_change=(($new->number-$no)/$no);
        $enrollment->save();

    }
    







    }

    $enroll=enrollment::select('percentage_change')->pluck('percentage_change');
        //$data=array(50,100,300,400,5757,3533,3636,3873,3838,488,8494,4949);
        $labels=array("January","February","March","April","May","June","July","August","September","October","November","December");
         
        $chart = Charts::create('line','chartjs')
        ->title('Percentage Change Per Month')
        ->elementLabel("Percentage Change")
        ->labels($labels)
        ->Values($enroll)
        ->colors(['#800000'])
        ->Dimensions(1000,500)
        ->Responsive(false);
        return view('enrollment', compact('chart'));
return $enrollment;
    }
    public function funding()
    {   $funding=funding::select('amount')->pluck('amount');
       // $data=array(50,100,300,400,5757,3533,3636,3873,3838,488,8494,4949);
        $labels=array("January","February","March","April","May","June","July","August","September","October","November","December");
         
        $chart = Charts::create('bar','chartjs')
        ->title('Funding Per Month')
        ->elementLabel("Fundings")
        ->labels($labels)
        ->Values($funding)
        ->colors(['#008000', '#000000'])
        ->Dimensions(1000,500)
        ->Responsive(false);
        return view('funding', compact('chart'));
//return $enrollment;
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
        //
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
    public function destroy($id)
    {
        //
    }
}
