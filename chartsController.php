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
    {   $enrollment=enrollment::select('percentage_change')->pluck('percentage_change');
        //$data=array(50,100,300,400,5757,3533,3636,3873,3838,488,8494,4949);
        $labels=array("January","February","March","April","May","June","July","August","September","October","November","December");
         
        $chart = Charts::create('line', 'chartjs')
        ->title('Percentage Change Per Month')
        ->elementLabel("Percentage Change")
        ->labels($labels)
        ->Values($enrollment)
        ->Dimensions(1000,500)
        ->Responsive(false);
        return view('enrollment', compact('chart'));
//return $enrollment;
    }
    public function funding()
    {   $funding=funding::select('amount')->pluck('amount');
       // $data=array(50,100,300,400,5757,3533,3636,3873,3838,488,8494,4949);
        $labels=array("January","February","March","April","May","June","July","August","September","October","November","December");
         
        $chart = Charts::create('bar', 'chartjs')
        ->title('Funding Per Month')
        ->elementLabel("Fundings")
        ->labels($labels)
        ->Values($funding)
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
