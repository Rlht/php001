<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Osadnicy</title>
</head>
<body>
	<form action="zaloguj.php" method="post">
		Login:<br/> <input type="text" name="login" /> <br/>
		Haslo:<br/> <input type="password" name="haslo" /> <br/><br/>
		<input type="submit" value="Zaloguj sie" />
	</form>    
	
	<?php 
	
	if(isset($_SESSION['blad'])) {
	    echo $_SESSION['blad'];
	}
	?>
</body>
</html>