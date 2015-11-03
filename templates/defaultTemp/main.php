<!DOCTYPE html>
<html lang="ru">
<head>
<title>%title%</title>
	<meta charset='UTF-8' />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="templates/defaultTemp/js/style.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="templates/defaultTemp/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				%menu%
			</div>
			<div class="col-sm-3 col-sm-offset-6">
				%loginform%
			</div>
		</div>
			<div style="clear: left"></div>
		<div class="row">
			%content%
			<div style="clear: left"></div>
		</div>
		<div class="row">
			%footer%
		</div>
	</div>
</body>
</html>