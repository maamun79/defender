<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LocationUpdate;
use App\Criminal;
use Mail;
use App\Mail\sendLocation;

class LocationUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = LocationUpdate::latest()->paginate();
        return $location;
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
        $this->validate($request, [
            'location'         => 'required',
            'description'      => 'required',
            'sender_contact'   => 'required'
        ]);

        $location = new LocationUpdate();
        $location->criminal_id       = $criminal_id;
        $location->location          = $request->location;
        $location->description       = $request->description;
        $location->sender_contact    = $request->sender_contact;
        
        
        $location->save();
        
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
        $location = LocationUpdate::findOrFail($id);
        $location->delete();
    }

    public function sendLocation($locationId, $criminalId, $email){
        
        $location = LocationUpdate::where('id', $locationId)->get();
        $criminal = Criminal::where('id', $criminalId)->get();

        $subject = 'Most Wanted Offender Location update';
        $s_email = $email;
        // $message = $complain;

        // $newmsg = 'Location: '.$location[0]->location.'<br>Criminal: '.$criminal[0]->name;
        $newmsg = array('location'=>$location[0], 'criminal'=>$criminal[0]);
 
        // return $newmsg;

        
        Mail::to($s_email)->send(new sendLocation($subject, $newmsg));
        // return $newmsg;

        $location[0]->status = "Sent";
        $location[0]->save();
    }

    //------------Location update count for dashboard-------------------
    public function locationUpdateCount(){
        $locationUpdateCount = LocationUpdate::get()->count();
        return $locationUpdateCount;
    }
    //pending location update
    public function pendingLocationUpdateCount(){
        $pendingLocationUpdateCount = LocationUpdate::where('status', 'pending')->get()->count();
        return $pendingLocationUpdateCount;
    }
    // sent location update
    public function sentLocationUpdateCount(){
        $sentLocationUpdateCount = LocationUpdate::where('status', 'Sent')->get()->count();
        return $sentLocationUpdateCount;
    }
}
