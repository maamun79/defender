<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PoliceStation;

class PoliceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policeStation = PoliceStation::latest()->paginate(10);
        return $policeStation;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required',
            'district'   => 'required',
            'email'      => 'required|email|unique:police_stations',
            'contact'    => 'required'
        ]);

        return PoliceStation::create([
            'name'     => $request['name'],
            'district' => $request['district'],
            'email'    => $request['email'],
            'contact'  => $request['contact']
            
        ]);
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
        $policeStation = PoliceStation::findOrFail($id);

        $this->validate($request, [
            'name'       => 'required',
            'district'   => 'required',
            'email'      => 'required|email|unique:police_stations,email,'.$policeStation->id,
            'contact'    => 'required'
        ]);

        $policeStation->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policeStation = PoliceStation::findOrFail($id);
        $policeStation->delete();
    }
}
