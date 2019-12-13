<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2><b>Offender Information</b></h2>
    <h4><b>Name : </b> {{ $e_msg['criminal']['name']}}</h4>
    <h4><b>DOB : </b> {{ $e_msg['criminal']['dob']}}</h4>
    <h4><b>NID No. : </b> {{ $e_msg['criminal']['nid']}}</h4>
    <h4><b>Address : </b> {{ $e_msg['criminal']['residence']}}</h4>
    <h4><b>Skin Color : </b> {{ $e_msg['criminal']['skin_color']}}</h4>
    <h4><b>Hair Color : </b> {{ $e_msg['criminal']['hair_color']}}</h4>
    <h4><b>Height(cm) : </b> {{ $e_msg['criminal']['height']}}</h4>
    <h4><b>Gender : </b> {{ $e_msg['criminal']['gender']}}</h4>
    <h4><b>Threat Level : </b> {{ $e_msg['criminal']['current_threat_level']}}</h4>
    <h4><b>Current Status : </b> {{ $e_msg['criminal']['current_status']}}</h4>

    <h2><b>Location Update</b></h2>
    <h4><b>Location : </b>{{ $e_msg['location']['location']}}</h4>
    <h4><b>Description : </b>{{ $e_msg['location']['description']}}</h4>
    <h4><b>Sender Contact : </b>{{ $e_msg['location']['sender_contact']}}</h4>
    <h4><b>Complain Time : </b>{{ $e_msg['location']['created_at']}}</h4>
    
</body>
</html>