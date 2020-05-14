<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Email</title>
</head>
<body>
    <h2>Welcome to the site {{$user['name']}}</h2>
    <br/>
    Your registered email is {{$user['email']}}
</body>
</html>