<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Company Name : {{$e_msg->company_name}}</h3>
    <h4>Company Type : {{$e_msg->company_type}}</h4>
    <h4>Company Address : {{$e_msg->company_address}}</h4>
    <h4>Accused Person : {{$e_msg->person_name}}</h4>
    <h4>Designation : {{$e_msg->designation}}</h4>
    <h4>Accused Person : {{$e_msg->person_name}}</h4>
    <p>Details : {{$e_msg->description}}</p>
    <h4>Complainant's Contact : {{$e_msg->sender_contact}}</h4>

    
</body>
</html>