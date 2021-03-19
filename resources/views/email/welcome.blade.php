<html>
	<head>
		<title>Welcome User</title>
	</head>
	<body>
		{{ $user['email'] }}
		<br>
		<p>Your e-exam otp is : {{ $user['confirmation_code'] }}</p>
		
	</body>
</html>