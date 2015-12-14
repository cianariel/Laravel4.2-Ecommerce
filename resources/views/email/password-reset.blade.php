<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="content">
    <div class="title">Dear {{ $name }}</div>
    Please click on the "Reset" link to Reset your email [ <a href="{{ url('/password-reset-form').'/'.$code}}">Verify</a> ]
</div>

</body>
</html>
