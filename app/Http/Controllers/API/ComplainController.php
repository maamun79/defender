<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complain;
use Mail;
use App\Mail\SendEmail;
use App\Mail\SendPublicComplain;
use App\Mail\SendSocialComplain;
use App\PublicPlaceComplain;
use App\SocialMediaComplain;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //----------------------Viewing complains-------------------------

    public function index()
    {
        $complain = Complain::latest()->paginate();
        return $complain;
    }
    
    public function getPublicPlaceComplain(){
        $publicPlaceComplain = PublicPlaceComplain::latest()->paginate(10);
        return $publicPlaceComplain;
    }
    public function getSocialMediaComplain(){
        $socialMediaComplain = SocialMediaComplain::latest()->paginate(10);
        return $socialMediaComplain;
    }
    //----------------------End Viewing complains-------------------------

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
    //===================================================================================
                         // posting Complains
    //===================================================================================

          //----------------------Work place complain-------------------------
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name'         => 'required',
            'company_type'         => 'required',
            'company_address'      => 'required',
            'person_name'          => 'required',
            'designation'          => 'required',
            'description'          => 'required',
            'sender_contact'       => 'required',
            'crime_type'           => 'required'
        ]);

        $complain = new Complain();
        $complain->company_name       = $request->company_name;
        $complain->company_type       = $request->company_type;
        $complain->company_address    = $request->company_address;
        $complain->person_name        = $request->person_name;
        $complain->designation        = $request->designation;
        $complain->description        = $request->description;
        $complain->sender_contact     = $request->sender_contact;
        $complain->crime_type         = $request->crime_type;

        $complain->save();

    
    }
       //----------------------public place complain-------------------------
    public function postPublicPlaceComplain(Request $request){

        $this->validate($request, [
            'location'          => 'required',
            'description'       => 'required',
            'sender_contact'    => 'required'
        ]);
        
        if($request->photo){

            $photoName = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/publicPlaceComplain/').$photoName);

        }
        if($request->video){
            $fileName = time().'.'.$request->video->getClientOriginalExtension();
            //$fileName = time().'.mp4';
            $request->video->move(public_path('video/publicPlaceComplain/'), $fileName);
        }
        
       
        // if($request->video){
        //     $videoName = time().'.' . explode('/', explode(':', substr($request->video, 0, strpos($request->video, ';')))[1])[1];
        //     $request->video->save(public_path('video/publicPlaceComplain/').$videoName);
        // }

        $publicPlaceComplain = new PublicPlaceComplain();
        $publicPlaceComplain->location          = $request->location;
        $publicPlaceComplain->description       = $request->description;
        $publicPlaceComplain->sender_contact    = $request->sender_contact;
        $publicPlaceComplain->photo             = $photoName;
        $publicPlaceComplain->video             = $fileName;
        $publicPlaceComplain->save();
    }
       //----------------------Social Media complain-------------------------

    public function postSocialMediaComplain(Request $request){
        $this->validate($request, [
            'description'       => 'required',
            'sender_contact'    => 'required'
        ]);
        
        if($request->photo){

            $photoName = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/socialMediaComplain/').$photoName);

        }
        if($request->video){
            $fileName = time().'.'.$request->video->getClientOriginalExtension();
            //$fileName = time().'.mp4';
            $request->video->move(public_path('video/socialMediaComplain/'), $fileName);
        }

        

        $socialMediaComplain = new SocialMediaComplain();
        $socialMediaComplain->profile          = $request->profile;
        $socialMediaComplain->description       = $request->description;
        $socialMediaComplain->sender_contact    = $request->sender_contact;
        $socialMediaComplain->photo             = $photoName;
        $socialMediaComplain->video             = $fileName;
        $socialMediaComplain->save();
    }
    //===================================================================================
                         // End posting Complains
    //===================================================================================
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


    //------------------- Work place complain sending through email------------------------

    public function send($complainId , $email ){
        $complain = Complain::where('id', $complainId)->get();

        $subject = 'Work Place Complain';
        $s_email = $email;
        $message = $complain;
        // $data = array('name'=>"Sam Jose", "body" => "Test mail");

        Mail::to($s_email)->send(new SendEmail($subject, $message));
        
        $complain[0]->status = "Sent";
        $complain[0]->save();
            
        // echo "{$complainId} -> {$email}";
    }
    //------------------- Public place complain sending through email------------------------

    public function sendPublicComplain($complainId, $email){
        $publicComplain = PublicPlaceComplain::where('id', $complainId)->get();

        $subject = 'Public Place Complain';
        $s_email = $email;
        $message = $publicComplain;
        // $data = array('name'=>"Sam Jose", "body" => "Test mail");

        Mail::to($s_email)->send(new SendPublicComplain($subject, $message));

        $publicComplain[0]->status = "Sent";
        $publicComplain[0]->save();
        

    }
    //------------------ Social media complain sending through email--------------------------

    public function sendSocialComplain($complainId, $email){
        $socialComplain = SocialMediaComplain::where('id', $complainId)->get();

        $subject = 'Social Media Complain';
        $s_email = $email;
        $message = $socialComplain;

        Mail::to($s_email)->send(new SendSocialComplain($subject, $message));

        $socialComplain[0]->status = "Sent";
        $socialComplain[0]->save();
        
    }
    // Complain counts for dashboard
    //workplace
    public function workPlaceComplainsCount(){
        $workPlaceComplainsCount = Complain::get()->count();
        return $workPlaceComplainsCount;
    }
    public function pendingWorkPlaceComplainsCount(){
        $pendingWorkPlaceComplainsCount = Complain::where('status', 'pending')->get()->count();
        return $pendingWorkPlaceComplainsCount;
    }
    public function sentWorkPlaceComplainsCount(){
        $sentWorkPlaceComplainsCount = Complain::where('status', 'Sent')->get()->count();
        return $sentWorkPlaceComplainsCount;
    }
    //public place
    public function publicPlaceComplainsCount(){
        $publicPlaceComplainsCount = PublicPlaceComplain::get()->count();
        return $publicPlaceComplainsCount;
    }
    public function pendingPublicPlaceComplainsCount(){
        $pendingPublicPlaceComplainsCount = PublicPlaceComplain::where('status', 'pending')->get()->count();
        return $pendingPublicPlaceComplainsCount;
    }
    public function sentPublicPlaceComplainsCount(){
        $sentPublicPlaceComplainsCount = PublicPlaceComplain::where('status', 'Sent')->get()->count();
        return $sentPublicPlaceComplainsCount;
    }
    //social media
    public function socialMediaComplainsCount(){
        $socialMediaComplainsCount = SocialMediaComplain::get()->count();
        return $socialMediaComplainsCount;
    }
    public function pendingSocialMediaComplainsCount(){
        $pendingSocialMediaComplainsCount = SocialMediaComplain::where('status', 'pending')->get()->count();
        return $pendingSocialMediaComplainsCount;
    }
    public function sentSocialMediaComplainsCount(){
        $sentSocialMediaComplainsCount = SocialMediaComplain::where('status', 'Sent')->get()->count();
        return $sentSocialMediaComplainsCount;
    }
    //delete workplace complain
    public function deleteWorkPlaceComplain($id){
        $workPlaceComplain = Complain::findOrFail($id);
        $workPlaceComplain->delete();
        
    }
    //delete public place complain
    public function deletePublicPlaceComplain($id){
        $publicPlaceComplain = PublicPlaceComplain::findOrFail($id);
        $publicPlaceComplain->delete();
        
    }
    //delete social media complain
    public function deleteSocialMediaComplain($id){
        $socialMediaComplain = SocialMediaComplain::findOrFail($id);
        $socialMediaComplain->delete();
        
    }
}
