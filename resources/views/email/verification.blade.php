<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="content">
    <div class="title">Dear {{ $name }}</div>
    Please click on the "Verify" link to verify your email [ <a href="{{ url('/verify-email').'/'.$link}}">Verify</a> ]
</div>

</body>
</html>
