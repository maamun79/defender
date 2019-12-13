<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MissingPersonLocationUpdate;
use App\MissingPerson;
use Mail;
use App\Mail\MissingPersonLocation;

class MissingPersonLocationUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = MissingPersonLocationUpdate::latest()->paginate();
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
    public function store(Request $request, $missing_id)
    {
        $this->validate($request, [
            'where_seen'       => 'required',
            'clothing_details' => 'required',
            'details'          => 'required',
            'date_of_seen'     => 'required|date',
            'sender_name'      => 'required',
            'sender_contact'   => 'required',
        ]);

        $location = new MissingPersonLocationUpdate();
        $location->missing_person_id  = $missing_id;
        $location->where_seen         = $request->where_seen;
        $location->clothing_details   = $request->clothing_details;
        $location->details            = $request->details;
        $location->date_of_seen       = $request->date_of_seen;
        $location->sender_name        = $request->sender_name;
        $location->sender_contact     = $request->sender_contact;
        
        
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
        //
    }

    //sending location through mail
    public function sendMLocation($locationId, $personId, $email){
        
        $location = MissingPersonLocationUpdate::where('id', $locationId)->get();
        $person = MissingPerson::where('id', $personId)->get();

        $subject = 'Missing Person Location update';
        $s_email = $email;
        // $message = $complain;

        // $newmsg = 'Location: '.$location[0]->location.'<br>Criminal: '.$criminal[0]->name;
        $newmsg = array('location'=>$location[0], 'person'=>$person[0]);
 
        // return $newmsg;

        
        Mail::to($s_email)->send(new MissingPersonLocation($subject, $newmsg));
        // return $newmsg;

        $location[0]->status = "Sent";
        $location[0]->save();
    }
}
