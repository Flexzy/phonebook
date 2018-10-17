<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" >
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Phonebook</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
	<div id="app">
		<Myheader></Myheader>
			<div class="container">
				<router-view></router-view>
			</div>
		<Myfooter></Myfooter>
	</div>
</body>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>