<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the Behere {{ $full_name }}</h2>
<br/>
Your registered email-id is {{ $email }} , Please click on the below link to verify your email account
<br/>
<a href="{{url('verify',$email_verified_at)}}">Verify Email</a>
</body>

</html>