<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MissingPerson;

class MissingPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missingPerson = MissingPerson::latest()->paginate();
        return $missingPerson;
    }

    public function showMissingPerson()
    {
        $missingPerson = MissingPerson::where('status', 'Active')->latest()->paginate();
        return $missingPerson;
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
        $this->validate($request, [
            'name'                  => 'required',
            'dob'                   => 'required|date',
            'gender'                => 'required',
            'height'                => 'required',
            'weight'                => 'required',
            'hair_color'            => 'required',
            'eye_color'             => 'required',
            'skin_color'            => 'required',
            'missing_from'          => 'required',
            'clothing_description'  => 'required',
            'unique_identifiers'    => 'required',
            'date_missing'          => 'required|date',
            'details'               => 'required',
            'photo'                 => 'required',
            // 'photo'                => 'required | mimes:image/png'
        ]);
        print_r($request->photo);
        // image uploading
        if($request->photo){

            $photoName = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/missingPerson/').$photoName);
            

          }
        

        $missingPerson = new MissingPerson();
        $missingPerson->name                  = $request->name;
        $missingPerson->dob                   = $request->dob;
        $missingPerson->gender                = $request->gender;
        $missingPerson->height                = $request->height;
        $missingPerson->weight                = $request->weight;
        $missingPerson->hair_color            = $request->hair_color;
        $missingPerson->eye_color             = $request->eye_color;
        $missingPerson->skin_color            = $request->skin_color;
        $missingPerson->missing_from          = $request->missing_from;
        $missingPerson->clothing_description  = $request->clothing_description;
        $missingPerson->unique_identifiers    = $request->unique_identifiers;
        $missingPerson->date_missing          = $request->date_missing;
        $missingPerson->details               = $request->details;
        $missingPerson->photo                 = $photoName;
        $missingPerson->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return MissingPerson::find($id);
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
        $missingPerson = MissingPerson::findOrFail($id);

        $this->validate($request, [
            'name'                  => 'required',
            'dob'                   => 'required|date',
            'gender'                => 'required',
            'height'                => 'required',
            'weight'                => 'required',
            'hair_color'            => 'required',
            'eye_color'             => 'required',
            'skin_color'            => 'required',
            'missing_from'          => 'required',
            'clothing_description'  => 'required',
            'unique_identifiers'    => 'required',
            'date_missing'          => 'required|date',
            'details'               => 'required',
            'photo'                 => 'required',
        ]);

        $current_photo = $missingPerson->photo;
        if($request->photo != $current_photo ){
            $photoName = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/missingPerson/').$photoName);
            $request->merge(['photo' => $photoName]);
        }

        $missingPersonPhoto = public_path('img/criminal/').$current_photo;
        if(file_exists($missingPersonPhoto)){
            @unlink($missingPersonPhoto);
        }

        $missingPerson->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $missingPerson = MissingPerson::findOrFail($id);
        $missingPerson->delete();
    }

        //activate search
        public function activeSearch($id){
            $missingPerson = MissingPerson::where('id', $id)->get();
            $missingPerson[0]->status = "Active";
            $missingPerson[0]->save();
        }
        //mute search
        public function muteSearch($id){
            $missingPerson = MissingPerson::where('id', $id)->get();
            $missingPerson[0]->status = "Mute";
            $missingPerson[0]->save();
        }

       //Most wanted location update
        public function missingLocationUpdate($missing_person_id){
            // $findPerson = MissingPerson::where('id', $missing_person_id)->get();
            // return $findPerson;
            return "OK";
        }
        //view 

}
