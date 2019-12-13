<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Criminal;

class CriminalController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criminal = Criminal::latest()->paginate();
        return $criminal;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $toDay = date('Y-m-d');
        $this->validate($request, [
            'name'                     => 'required',
            'dob'                      => 'required|date|before:'.$toDay,
            'nid'                      => 'required',
            'residence'                => 'required',
            'skin_color'               => 'required',
            'hair_color'               => 'required',
            'height'                   => 'required',
            'gender'                   => 'required',
            'current_threat_level'     => 'required',
            'current_status'           => 'required',
            'photo'                    => 'required',
            'registration_ending_date' => 'required',
            'state'                    => 'required',
            // 'photo'                => 'required | mimes:image/png'
        ]);
        print_r($request->photo);
        // image uploading
        if($request->photo){

            $photoName = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/criminal/').$photoName);

          }
        

        $criminal = new Criminal();
        $criminal->name                      = $request->name;
        $criminal->dob                       = $request->dob;
        $criminal->nid                       = $request->nid;
        $criminal->residence                 = $request->residence;
        $criminal->skin_color                = $request->skin_color;
        $criminal->hair_color                = $request->hair_color;
        $criminal->height                    = $request->height;
        $criminal->gender                    = $request->gender;
        $criminal->current_threat_level      = $request->current_threat_level;
        $criminal->current_status            = $request->current_status;
        // $request->merge(['photo' => $photoName]);
        $criminal->photo                     = $photoName;
        $criminal->registration_ending_date  = $request->registration_ending_date;
        $criminal->state                     = $request->state;
        $criminal->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Criminal::find($id);
        


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
        $criminal = Criminal::findOrFail($id);

        $this->validate($request, [
            'name'                     => 'required',
            'dob'                      => 'required|date',
            'nid'                      => 'required',
            'residence'                => 'required',
            'skin_color'               => 'required',
            'hair_color'               => 'required',
            'height'                   => 'required',
            'gender'                   => 'required',
            'current_threat_level'     => 'required',
            'current_status'           => 'required',
            'registration_ending_date' => 'required',
            'state'                    => 'required',
        ]);

        $current_photo = $criminal->photo;
        if($request->photo != $current_photo ){
            $photoName = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/criminal/').$photoName);
            $request->merge(['photo' => $photoName]);
        }

        $criminalPhoto = public_path('img/criminal/').$current_photo;
        if(file_exists($criminalPhoto)){
            @unlink($criminalPhoto);
        }

        $criminal->update($request->all());
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $criminal = Criminal::findOrFail($id);
        $criminal->delete();
    }

    //finding most wanted criminal
    public function mostWantedCriminal(){
        $mostWanted = Criminal::where('current_status', 'Most Wanted')
                               ->where('search_status', 'Active')->latest()->get();
        return $mostWanted;

    }
    //Most wanted location update
    public function mostWantedLocationUpdate($criminal_id){
        $mostWantedCrm = Criminal::where('id', $criminal_id)->get();
        return $mostWantedCrm;
    }

    //search offender
    public function search(){
        if($search = \Request::get('q')){
            $offenders = Criminal::where('search_status', 'Active')
                ->where(function($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                      ->orWhere('nid', 'LIKE', "%$search%")
                      ->orWhere('state', 'LIKE', "%$search%")
                      ->orWhere('residence', 'LIKE', "%$search%");
            })->paginate(20);
        }else{
            $offenders= json_encode(array("data"=>[]));          
        }
        return $offenders;
    }

     //search most wanted
     public function searchMostWanted(){
        if($searchMostWanted = \Request::get('q')){
            $offenders = Criminal::where('current_status', 'Most Wanted')
               ->where('search_status', 'Active')
               ->where(function($query) use ($searchMostWanted){
                $query->where('name', 'LIKE', "%$searchMostWanted%")
                      ->orWhere('nid', 'LIKE', "%$searchMostWanted%")
                      ->orWhere('residence', 'LIKE', "%$searchMostWanted%");
            })->paginate(20);
        }else{
            return "No Results Found";
        }
        return $offenders;
    }
    //activate search
    public function activeSearch($id){
        $aCriminal = Criminal::where('id', $id)->get();
        $aCriminal[0]->search_status = "Active";
        $aCriminal[0]->save();
    }
    //mute search
    public function muteSearch($id){
        $aCriminal = Criminal::where('id', $id)->get();
        $aCriminal[0]->search_status = "Muted";
        $aCriminal[0]->save();
    }
//=================================================================
                  //dashboard
//=================================================================
    //-----------offender count for dashboard-----------------
    public function offenderCount(){
        $offenderCount = Criminal::get()->count();
        return $offenderCount;
    }
    //-------------free offender count-----------------
    public function freeOffenderCount(){
        $freeOffenderCount = Criminal::where('current_status', 'Free')->get()->count();
        return $freeOffenderCount;
    }
    //-------------detained offender count-----------------
    public function detainedOffenderCount(){
        $detainedOffenderCount = Criminal::where('current_status', 'Detained')->get()->count();
        return $detainedOffenderCount;
    }
    //-------------most wanted offender count-----------------
    public function mostWantedOffenderCount(){
        $mostWantedOffenderCount = Criminal::where('current_status', 'Most Wanted')->get()->count();
        return $mostWantedOffenderCount;
    }
    //-------------high risk offender count-----------------
    public function highRiskOffenderCount(){
        $highRiskOffenderCount = Criminal::where('current_threat_level', 'High')->get()->count();
        return $highRiskOffenderCount;
    }
    
}
