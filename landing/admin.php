<?php 
    session_start();

?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<title>Strona logowania Admin</title>
	<link href="https://fonts.googleapis.com/css?family=VT323&amp;subset=latin-ext" rel="stylesheet">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=VT323&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style_admin.css">
</head>
<body>
	<div id="container">
		<header>	
			<h1>Admin</h1>
		</header>
		<article>
			<form method="post" action="list.php">
				<input placeholder="login" type="text" name="login"><br/><br/>
				<input placeholder="password" type="password" name="pass"><br/><br/>
				<input id="log" type="submit" value="Zaloguj">
			</form>
		</article>
	</div>
</body>
</html>