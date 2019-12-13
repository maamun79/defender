<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2><b>Missing Person Information</b></h2>
    <h4><b>Name : </b> {{ $e_msg['person']['name']}}</h4>
    <h4><b>DOB : </b> {{ $e_msg['person']['dob']}}</h4>
    <h4><b>Gender : </b> {{ $e_msg['person']['gender']}}</h4>
    <h4><b>Height(cm) : </b> {{ $e_msg['person']['height']}}</h4>
    <h4><b>Weight : </b> {{ $e_msg['person']['weight']}}</h4>
    <h4><b>Hair Color : </b> {{ $e_msg['person']['hair_color']}}</h4>
    <h4><b>Eye Color : </b> {{ $e_msg['person']['eye_color']}}</h4>
    <h4><b>Skin Color : </b> {{ $e_msg['person']['skin_color']}}</h4> 
    <h4><b>Missing From : </b> {{ $e_msg['person']['missing_from']}}</h4>
    <h4><b>Clothing Description : </b> {{ $e_msg['person']['clothing_description']}}</h4>
    <h4><b>Unique Identifiers : </b> {{ $e_msg['person']['unique_identifiers']}}</h4>
    <h4><b>Missing Date : </b> {{ $e_msg['person']['date_missing']}}</h4>
    <h4><b>Details: </b> {{ $e_msg['person']['details']}}</h4>

    <h2><b>Location Update</b></h2>
    <h4><b>Where Seen : </b>{{ $e_msg['location']['where_seen']}}</h4>
    <h4><b>Clothing Details : </b>{{ $e_msg['location']['clothing_details']}}</h4>
    <h4><b>Date of Seen : </b>{{ $e_msg['location']['date_of_seen']}}</h4>
    <h4><b>Sender Name : </b>{{ $e_msg['location']['sender_name']}}</h4>
    <h4><b>Sender Contact : </b>{{ $e_msg['location']['sender_contact']}}</h4>
    
</body>
</html>