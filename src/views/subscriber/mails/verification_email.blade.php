<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Verification</title>
</head>
<body>
    <h2>Welcome to the site {{$user['name']}}</h2>
    <br/>
    Your registered email is {{$user['email']}} , Please click on the below link to verify your email account
    <br/>
    <a href="{{url('account/user/verified', $user->accountVerification->token)}}">Verify Email</a>
</body>
</html>