<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('backend/assets/css/responsive.css')}}">
</head>
<body>
	
	@yield("content")


	<!-- JS FILES  -->
	<script src="{{ asset('backend/assets/js/jquery-3.4.1.min.js')}}"></script>
	<script src="{{ asset('backend/assets/js/popper.min.js')}}"></script>
	<script src="{{ asset('backend/assets/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('backend/assets/js/custom.js')}}"></script>
</body>
</html>