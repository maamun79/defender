<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Admin routing


Route::apiResources(['user' => 'API\UserController']);

Route::apiResources(['criminal' => 'API\CriminalController']);

Route::apiResources(['missingPerson' => 'API\MissingPersonController']);
Route::get('showMissingPerson', 'API\MissingPersonController@showMissingPerson');
// Route::get('missingPerson/{id}', 'API\MissingPersonController@viewDetails');
Route::get('missingPersonActiveStatus/{id}', 'API\MissingPersonController@activeSearch');
Route::get('missingPersonMuteStatus/{id}', 'API\MissingPersonController@muteSearch');

Route::apiResources(['missingPersonLocation' => 'API\MissingPersonLocationUpdateController']);
Route::get('missingPerson/{id}', 'API\MissingPersonController@missingLocationUpdate');
Route::get('sendMiddingPersonLocation/{locationId}/{personId}/{email}', 'API\MissingPersonLocationUpdateController@sendMLocation');

// Route::get('criminal/{id}', 'API\CriminalController@show');

// Route::apiResources(['offense' => 'API\OffenseController']);

Route::get('offense/{id}', 'API\OffenseController@index');
Route::post('offense/create/{id}', 'API\OffenseController@store');
Route::put('offense/{id}', 'API\OffenseController@update');

Route::apiResources(['complain' => 'API\ComplainController']);
Route::get('complain/{complainId}/{email}', 'API\ComplainController@send');
Route::get('publicComplain/{complainId}/{email}', 'API\ComplainController@sendPublicComplain');
Route::get('socialComplain/{complainId}/{email}', 'API\ComplainController@sendSocialComplain');



Route::get('getPublicPlaceComplain', 'API\ComplainController@getPublicPlaceComplain');
Route::get('getSocialMediaComplain', 'API\ComplainController@getSocialMediaComplain');

Route::apiResources(['location' => 'API\LocationUpdateController']);
Route::get('sendLocation/{locationId}/{criminalId}/{email}', 'API\LocationUpdateController@sendLocation');

Route::apiResources(['policeStation' => 'API\PoliceStationController']);

Route::get('criminal/mostWanted/{id}', 'API\CriminalController@mostWantedLocationUpdate');

Route::get('activeStatus/{id}', 'API\CriminalController@activeSearch');
Route::get('muteStatus/{id}', 'API\CriminalController@muteSearch');

Route::apiResources(['safety' => 'API\SafetyController']);

//delete workplace complain
Route::delete('deleteWorkPlaceComplain/{id}', 'API\ComplainController@deleteWorkPlaceComplain');
//delete public place complain
Route::delete('deletePublicPlaceComplain/{id}', 'API\ComplainController@deletePublicPlaceComplain');
//delete social media complain
Route::delete('deleteSocialMediaComplain/{id}', 'API\ComplainController@deleteSocialMediaComplain');



//-------------------dashboard----------------
// offender 
Route::get('offenderCount', 'API\CriminalController@offenderCount');
Route::get('mostWantedOffenderCount', 'API\CriminalController@mostWantedOffenderCount');
Route::get('freeOffenderCount', 'API\CriminalController@freeOffenderCount');
Route::get('detainedOffenderCount', 'API\CriminalController@detainedOffenderCount');
Route::get('highRiskOffenderCount', 'API\CriminalController@highRiskOffenderCount');
//location update
Route::get('locationUpdateCount', 'API\LocationUpdateController@locationUpdateCount');
Route::get('pendingLocationUpdateCount', 'API\LocationUpdateController@pendingLocationUpdateCount');
Route::get('sentLocationUpdateCount', 'API\LocationUpdateController@sentLocationUpdateCount');
//work place complains
Route::get('workPlaceComplainsCount', 'API\ComplainController@workPlaceComplainsCount');
Route::get('pendingWorkPlaceComplainsCount', 'API\ComplainController@pendingWorkPlaceComplainsCount');
Route::get('sentWorkPlaceComplainsCount', 'API\ComplainController@sentWorkPlaceComplainsCount');
//public place complains
Route::get('publicPlaceComplainsCount', 'API\ComplainController@publicPlaceComplainsCount');
Route::get('pendingPublicPlaceComplainsCount', 'API\ComplainController@pendingPublicPlaceComplainsCount');
Route::get('sentPublicPlaceComplainsCount', 'API\ComplainController@sentPublicPlaceComplainsCount');
//social media complains
Route::get('socialMediaComplainsCount', 'API\ComplainController@socialMediaComplainsCount');
Route::get('pendingSocialMediaComplainsCount', 'API\ComplainController@pendingSocialMediaComplainsCount');
Route::get('sentSocialMediaComplainsCount', 'API\ComplainController@sentSocialMediaComplainsCount');




// ./Admin routing

// Front routing
Route::get('mostWanted', 'API\CriminalController@mostWantedCriminal');

Route::post('location/create/{id}', 'API\LocationUpdateController@store');

Route::post('publicPlaceComplain', 'API\ComplainController@postPublicPlaceComplain');

Route::post('socialMediaComplain', 'API\ComplainController@postSocialMediaComplain');
//search route
Route::get('findOffender', 'API\CriminalController@search');
//search most wanted
Route::get('findMostWanted', 'API\CriminalController@searchMostWanted');

//location update from user for missing person
Route::post('missingPersonLocation/create/{id}', 'API\MissingPersonLocationUpdateController@store');



