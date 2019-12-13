<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Offense;

class OffenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($crm_id)
    {
        $offenses = Offense::where('criminal_id', $crm_id)->latest()->get();
        return $offenses;
        
       
        // ->toArray();

        // echo "<pre>";
        // print_r($offenses);
       
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
    public function store(Request $request, $criminal_id)
    {
        $date = date('Y-m-d');
        $this->validate($request, [
            'title'         => 'required',
            'location'      => 'required',
            'date'          => 'required|date|before:'.$date,
            'detain_date'   => 'required|date',
            'release_date'  => 'required|date',
            'release_type'  => 'required',
            'statute'       => 'required',
            'judgment'      => 'required',
            'victim_gender' => 'required',
            'victim_age'    => 'required'
        ]);

        $offense = new Offense();
        $offense->criminal_id    = $criminal_id;
        $offense->title          = $request->title;
        $offense->location       = $request->location;
        $offense->date           = $request->date;
        $offense->detain_date    = $request->detain_date;
        $offense->release_date   = $request->release_date;
        $offense->release_type   = $request->release_type;
        $offense->statute        = $request->statute;
        $offense->judgment       = $request->judgment;
        $offense->victim_gender  = $request->victim_gender;
        $offense->victim_age     = $request->victim_age;
        
        
        $offense->save();
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
        $offense = Offense::findOrFail($id);

        $this->validate($request, [
            'title'         => 'required',
            'location'      => 'required',
            'date'          => 'required|date',
            'detain_date'   => 'required|date',
            'release_date'  => 'required|date',
            'release_type'  => 'required',
            'statute'       => 'required',
            'judgment'      => 'required',
            'victim_gender' => 'required',
            'victim_age'    => 'required'
        ]);

        $offense->update($request->all());

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
